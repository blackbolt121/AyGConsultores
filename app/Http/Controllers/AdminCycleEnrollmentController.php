<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\Enrollment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminCycleEnrollmentController extends Controller
{
    public function index(CourseCycle $ciclo)
    {
        $ciclo->loadMissing('course');

        $enrollments = Enrollment::query()
            ->where('course_cycle_id', $ciclo->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();

        $courseId = $ciclo->course_id;

        $blockedUserIds = Enrollment::query()
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $courseId))
            ->pluck('user_id')
            ->unique();

        $accreditedUserIds = Enrollment::query()
            ->whereNotNull('accredited_at')
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $courseId))
            ->pluck('user_id')
            ->unique();

        $excluded = $blockedUserIds->merge($accreditedUserIds)->merge($enrollments->pluck('user_id'))->unique();

        $availableUsers = User::query()
            ->where('role', User::ROLE_STUDENT)
            ->when($excluded->isNotEmpty(), fn ($q) => $q->whereNotIn('id', $excluded))
            ->orderBy('name')
            ->get();

        return view('admin.cycles.enrollments', compact('ciclo', 'enrollments', 'availableUsers'));
    }

    public function store(Request $request, CourseCycle $ciclo)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'enrolled_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:enrolled_at'],
        ]);

        $user = User::findOrFail($data['user_id']);
        abort_unless($user->isStudent(), 422, 'Solo puedes inscribir alumnos.');

        // capacity check (counts accessible enrollments)
        if ($ciclo->capacity > 0) {
            $count = Enrollment::query()
                ->where('course_cycle_id', $ciclo->id)
                ->accessible()
                ->count();
            if ($count >= $ciclo->capacity) {
                return back()->withErrors(['user_id' => 'Cupo completo para este ciclo.'])->withInput();
            }
        }

        // block if active in same version (same course_id)
        $hasActiveSameVersion = Enrollment::query()
            ->where('user_id', $user->id)
            ->accessible()
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $ciclo->course_id))
            ->exists();

        if ($hasActiveSameVersion) {
            return back()->withErrors(['user_id' => 'El alumno ya tiene un ciclo activo en esta version del curso.'])->withInput();
        }

        $hasAccreditedSameVersion = Enrollment::query()
            ->where('user_id', $user->id)
            ->whereNotNull('accredited_at')
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $ciclo->course_id))
            ->exists();

        if ($hasAccreditedSameVersion) {
            return back()->withErrors(['user_id' => 'El alumno ya esta acreditado en esta version del curso.'])->withInput();
        }

        Enrollment::updateOrCreate(
            [
                'course_cycle_id' => $ciclo->id,
                'user_id' => $user->id,
            ],
            [
                // keep legacy course_id filled for now
                'course_id' => $ciclo->course_id,
                'enrolled_at' => $data['enrolled_at'] ? Carbon::parse($data['enrolled_at']) : now(),
                'expires_at' => $data['expires_at'] ? Carbon::parse($data['expires_at']) : null,
                'status' => 'active',
            ]
        );

        return back()->with('status', 'Alumno inscrito correctamente.');
    }

    public function destroy(CourseCycle $ciclo, Enrollment $enrollment)
    {
        abort_unless($enrollment->course_cycle_id === $ciclo->id, 404);
        $enrollment->delete();
        return back()->with('status', 'Inscripcion eliminada correctamente.');
    }
}
