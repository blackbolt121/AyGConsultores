<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCourseEnrollmentController extends Controller
{
    public function index(Course $course)
    {
        $enrollments = $course->enrollments()->with('user')->orderBy('created_at', 'desc')->get();
        
        // Obtener usuarios que aún no están inscritos en este curso
        $enrolledUserIds = $enrollments->pluck('user_id')->toArray();
        $availableUsers = User::whereNotIn('id', $enrolledUserIds)->orderBy('name')->get();

        return view('admin.courses.enrollments', compact('course', 'enrollments', 'availableUsers'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'enrolled_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:enrolled_at',
        ]);

        Enrollment::updateOrCreate(
            [
                'course_id' => $course->id,
                'user_id' => $request->user_id,
            ],
            [
                'enrolled_at' => $request->enrolled_at ? \Carbon\Carbon::parse($request->enrolled_at) : now(),
                'expires_at' => $request->expires_at ? \Carbon\Carbon::parse($request->expires_at) : null,
                'status' => 'active',
            ]
        );

        return back()->with('status', 'Usuario inscrito exitosamente.');
    }

    public function destroy(Course $course, Enrollment $enrollment)
    {
        if ($enrollment->course_id !== $course->id) {
            abort(404);
        }
        
        $enrollment->delete();

        return back()->with('status', 'Inscripción eliminada correctamente.');
    }
}
