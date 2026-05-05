<?php

namespace App\Http\Controllers;

use App\Models\CourseContent;
use App\Models\CourseCycle;
use App\Models\CourseCycleMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocenteCycleMaterialController extends Controller
{
    public function index(Request $request, CourseCycle $ciclo)
    {
        $user = $request->user();
        abort_unless($user && ($user->isTeacher() || $user->isAdmin()), 403);

        $ciclo->loadMissing(['course.rootContents.children.children']);

        $materials = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->get()
            ->keyBy('course_content_id');

        return view('docente.ciclos.material', [
            'cycle' => $ciclo,
            'course' => $ciclo->course,
            'materials' => $materials,
        ]);
    }

    public function update(Request $request, CourseCycle $ciclo, CourseContent $contenido)
    {
        $user = $request->user();
        abort_unless($user && ($user->isTeacher() || $user->isAdmin()), 403);
        abort_unless($contenido->course_id === $ciclo->course_id, 404);

        $data = $request->validate([
            'content_type' => ['nullable', 'string', 'in:pdf,text'],
            'body' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $material = CourseCycleMaterial::firstOrNew([
            'course_cycle_id' => $ciclo->id,
            'course_content_id' => $contenido->id,
        ]);

        $material->content_type = $data['content_type'] ?? $material->content_type;
        $material->body = $data['body'] ?? $material->body;

        if ($request->hasFile('file')) {
            $dir = "private/materials/ciclos/{$ciclo->id}/{$contenido->id}";
            $original = $request->file('file')->getClientOriginalName();
            $name = time().'_'.preg_replace('/[^A-Za-z0-9._-]/', '_', $original);
            $path = $request->file('file')->storeAs($dir, $name, 'local');
            $material->file_path = $path;
            $material->content_type = 'pdf';
        }

        // If teacher selects PDF, require a file at least once.
        if (($material->content_type === 'pdf') && !$material->file_path) {
            return back()->withErrors(['file' => 'Debes subir un archivo PDF para este material.'])->withInput();
        }

        $material->save();

        return back()->with('status', 'Material actualizado correctamente.');
    }
}
