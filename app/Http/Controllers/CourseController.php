<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(12);

        if (request()->routeIs('admin.*')) {
            return view('admin.courses.index', compact('courses'));
        }

        return view('courses.index', compact('courses'));
    }

    public function show(string $slug)
    {
        $course = Course::where('slug',$slug)->firstOrFail();
        return view('courses.show', compact('course'));
    }

    public function category(string $category)
    {
        $courses = Course::where('category',$category)->paginate(12);
        return view('courses.index', compact('courses','category'));
    }

    public function create()
    {
        $categories = [
            'liderazgo' => 'Liderazgo',
            'desarrollo-personal' => 'Desarrollo Personal',
            'comunicacion' => 'Comunicación',
        ];
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:150'],
            'slug'        => ['nullable','string','max:160','unique:courses,slug'],
            'category'    => ['required','string','max:80'],
            'hours'       => ['required','integer','min:0','max:65535'],
            'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'excerpt'     => ['nullable','string'],
            'description' => ['nullable','string'],
            'featured'    => ['nullable','boolean'],
        ]);

        // Slug automático si no lo envían
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['featured'] = (bool) ($data['featured'] ?? false);

        // Subir imagen si viene
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // p.e. courses/abc.jpg
            $data['image'] = "storage/$path"; // para usar asset($course->image)
        }

        $course = Course::create($data);

        return redirect()
            ->route('admin.courses.edit', $course)
            ->with('status', 'Curso creado correctamente.');
    }

    public function edit(Course $course)
    {
        $categories = [
            'liderazgo' => 'Liderazgo',
            'desarrollo-personal' => 'Desarrollo Personal',
            'comunicacion' => 'Comunicación',
        ];
        return view('courses.edit', compact('course','categories'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:150'],
            'slug'        => ['nullable','string','max:160', Rule::unique('courses','slug')->ignore($course->id)],
            'category'    => ['required','string','max:80'],
            'hours'       => ['required','integer','min:0','max:65535'],
            'image'       => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'remove_image'=> ['nullable','boolean'],
            'excerpt'     => ['nullable','string'],
            'description' => ['nullable','string'],
            'featured'    => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['featured'] = (bool) ($data['featured'] ?? false);

        // Eliminar imagen si marcaron "remover" y existía
        if (($data['remove_image'] ?? false) && $course->image) {
            $this->deletePublicImagePath($course->image);
            $data['image'] = null;
        }
        unset($data['remove_image']);

        // Reemplazar imagen si suben nueva
        Log::info("Has image: ", ["hasImage"=>$request->hasFile('image')]);
        if ($request->hasFile('image')) {
            if ($course->image) {
                $this->deletePublicImagePath($course->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = "/storage/$path";
            Log::info('📸 Imagen guardada en ruta:', ['path' => $path]);
        }

        $course->update($data);

        return redirect()
            ->route('admin.courses.edit', $course)
            ->with('status', 'Curso actualizado correctamente.');
    }

    public function destroy(Course $course)
    {
        if ($course->image) {
            $this->deletePublicImagePath($course->image);
        }
        $course->delete();

        return redirect()->route('courses.index')->with('status', 'Curso eliminado.');
    }

    protected function deletePublicImagePath(string $publicPath): void
    {
        if (Str::startsWith($publicPath, 'images/')) {
            $relative = Str::after($publicPath, 'images/'); // courses/abc.jpg
            if (Storage::disk('public')->exists($relative)) {
                Storage::disk('public')->delete($relative);
            }
        }
    }

    public function show_course(int $id)
    {
        // Busca el curso o lanza 404 si no existe
        $course = Course::with([
            'rootContents.children.children', // árbol de contenido
            'contents.parent',                // numeración
        ])->findOrFail($id);
        return view('courses.show-course', compact('course'));
    }

}
