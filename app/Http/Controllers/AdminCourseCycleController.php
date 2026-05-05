<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCycle;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCourseCycleController extends Controller
{
    public function index(Course $course)
    {
        $cycles = $course->cycles()->withCount('enrollments')->orderByDesc('starts_at')->get();
        return view('admin.courses.cycles.index', compact('course', 'cycles'));
    }

    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'status' => ['required', 'string', 'in:draft,open,active,closed,archived'],
            'capacity' => ['required', 'integer', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $course->cycles()->create($data);
        return back()->with('status', 'Ciclo creado correctamente.');
    }

    public function edit(Course $course, CourseCycle $ciclo)
    {
        abort_unless($ciclo->course_id === $course->id, 404);

        $teachers = User::query()->where('role', User::ROLE_TEACHER)->orderBy('name')->get();
        $ciclo->loadMissing('teachers');

        return view('admin.courses.cycles.edit', compact('course', 'ciclo', 'teachers'));
    }

    public function update(Request $request, Course $course, CourseCycle $ciclo)
    {
        abort_unless($ciclo->course_id === $course->id, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'status' => ['required', 'string', 'in:draft,open,active,closed,archived'],
            'capacity' => ['required', 'integer', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'teachers' => ['nullable', 'array'],
            'teachers.*' => ['integer', 'exists:users,id'],
        ]);

        $teacherIds = collect($data['teachers'] ?? [])->unique()->values();
        unset($data['teachers']);

        $ciclo->update($data);

        if ($teacherIds->isNotEmpty()) {
            // only teachers
            $teacherIds = User::query()
                ->whereIn('id', $teacherIds)
                ->where('role', User::ROLE_TEACHER)
                ->pluck('id');
        }

        $ciclo->teachers()->sync($teacherIds->all());

        return back()->with('status', 'Ciclo actualizado correctamente.');
    }

    public function destroy(Course $course, CourseCycle $ciclo)
    {
        abort_unless($ciclo->course_id === $course->id, 404);
        $ciclo->delete();
        return redirect()->route('admin.courses.cycles.index', $course)->with('status', 'Ciclo eliminado.');
    }
}
