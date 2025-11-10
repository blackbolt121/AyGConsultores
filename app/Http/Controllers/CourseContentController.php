<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CourseContentController extends Controller
{
    // Crea item (raíz o hijo)
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'      => ['required','string','max:200'],
            'type'       => ['nullable','string','max:32'],
            'summary'    => ['nullable','string'],
            'body'       => ['nullable','string'],
            'parent_id'  => ['nullable','integer', Rule::exists('course_contents','id')],
        ]);

        // Validar que parent (si viene) pertenezca al mismo curso
        if (!empty($data['parent_id'])) {
            $parent = CourseContent::where('id', $data['parent_id'])
                ->where('course_id', $course->id)
                ->firstOrFail();
        }

        // sort_order: siguiente disponible entre hermanos
        $siblings = CourseContent::where('course_id', $course->id)
            ->when(!empty($data['parent_id']), fn($q) => $q->where('parent_id', $data['parent_id']),
                    fn($q) => $q->whereNull('parent_id'))
            ->max('sort_order');
        $next = (int)($siblings ?? 0) + 1;

        $content = CourseContent::create([
            'course_id'  => $course->id,
            'parent_id'  => $data['parent_id'] ?? null,
            'type'       => $data['type'] ?? 'section',
            'title'      => $data['title'],
            'summary'    => $data['summary'] ?? null,
            'body'       => $data['body'] ?? null,
            'sort_order' => $next,
        ]);

        return back()->with('status', 'Contenido creado: '.$content->title);
    }

    // Actualiza título/tipo/textos/parent y opción de reordenar (simple)
    public function update(Request $request, Course $course, CourseContent $content)
    {
        // Asegurar pertenencia
        abort_unless($content->course_id === $course->id, 404);

        $data = $request->validate([
            'title'      => ['required','string','max:200'],
            'type'       => ['nullable','string','max:32'],
            'summary'    => ['nullable','string'],
            'body'       => ['nullable','string'],
            'parent_id'  => ['nullable','integer', Rule::exists('course_contents','id')],
            'sort_order' => ['nullable','integer','min:1'],
        ]);

        // Si cambian de padre, normaliza sort_order al final de los nuevos hermanos
        if (array_key_exists('parent_id', $data)) {
            $newParentId = $data['parent_id'] ?? null;

            // Validar pertenencia de parent
            if ($newParentId) {
                CourseContent::where('id', $newParentId)
                    ->where('course_id', $course->id)->firstOrFail();
            }

            if ($newParentId !== $content->parent_id) {
                $max = CourseContent::where('course_id', $course->id)
                    ->when($newParentId, fn($q)=>$q->where('parent_id', $newParentId),
                                    fn($q)=>$q->whereNull('parent_id'))
                    ->max('sort_order');
                $data['sort_order'] = (int)($max ?? 0) + 1;
            }
        }

        $content->update([
            'title'      => $data['title'],
            'type'       => $data['type'] ?? $content->type,
            'summary'    => $data['summary'] ?? $content->summary,
            'body'       => $data['body'] ?? $content->body,
            'parent_id'  => $data['parent_id'] ?? $content->parent_id,
            'sort_order' => $data['sort_order'] ?? $content->sort_order,
        ]);

        return back()->with('status', 'Contenido actualizado: '.$content->title);
    }

    // Elimina (con cascadeOnDelete eliminan también sus hijos)
    public function destroy(Course $course, CourseContent $content)
    {
        abort_unless($content->course_id === $course->id, 404);
        $content->delete();

        return back()->with('status', 'Contenido eliminado.');
    }

    /**
     * Reordenar hermanos.
     * Espera: parent_id (nullable) + items[]=<content_id> en el orden deseado
     */
    public function reorder(Request $request, Course $course)
    {
        $data = $request->validate([
            'parent_id' => ['nullable','integer'],
            'items'     => ['required','array','min:1'],
            'items.*'   => ['integer', Rule::exists('course_contents','id')],
        ]);

        // (opcional) validar que todos los items pertenecen al curso y comparten el mismo parent
        $parentId = $data['parent_id'] ?? null;

        $contents = CourseContent::whereIn('id', $data['items'])
            ->where('course_id', $course->id)->get();

        // asigna sort_order incremental
        foreach ($data['items'] as $index => $id) {
            $node = $contents->firstWhere('id', $id);
            if (!$node) continue;
            // normaliza parent si viene parent_id (para evitar inconsistencias)
            if (($node->parent_id ?? null) !== $parentId) {
                $node->parent_id = $parentId;
            }
            $node->sort_order = $index + 1;
            $node->save();
        }

        return back()->with('status', 'Orden actualizado.');
    }
}
