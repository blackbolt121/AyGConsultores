<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminEnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'courseCycle.course'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        $users = User::where('role', User::ROLE_STUDENT)->orderBy('name')->get();
        $cycles = CourseCycle::with('course')->orderByDesc('starts_at')->get();

        return view('admin.enrollments.index', compact('enrollments', 'users', 'cycles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_cycle_id' => 'required|exists:course_cycles,id',
            'user_id' => 'required|exists:users,id',
            'enrolled_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:enrolled_at',
        ]);

        $cycle = CourseCycle::with('course')->findOrFail($request->course_cycle_id);
        $user = User::findOrFail($request->user_id);

        if (!$user->isStudent()) {
            return back()->withErrors(['user_id' => 'Solo puedes inscribir alumnos.'])->withInput();
        }

        if ($cycle->capacity > 0) {
            $count = Enrollment::query()->where('course_cycle_id', $cycle->id)->accessible()->count();
            if ($count >= $cycle->capacity) {
                return back()->withErrors(['course_cycle_id' => 'Cupo completo para este ciclo.'])->withInput();
            }
        }

        $hasActiveSameVersion = Enrollment::query()
            ->where('user_id', $user->id)
            ->accessible()
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $cycle->course_id))
            ->exists();

        if ($hasActiveSameVersion) {
            return back()->withErrors(['user_id' => 'El alumno ya tiene un ciclo activo en esta version del curso.'])->withInput();
        }

        $hasAccreditedSameVersion = Enrollment::query()
            ->where('user_id', $user->id)
            ->whereNotNull('accredited_at')
            ->whereHas('courseCycle', fn ($q) => $q->where('course_id', $cycle->course_id))
            ->exists();

        if ($hasAccreditedSameVersion) {
            return back()->withErrors(['user_id' => 'El alumno ya esta acreditado en esta version del curso.'])->withInput();
        }

        Enrollment::updateOrCreate(
            [
                'course_cycle_id' => $cycle->id,
                'user_id' => $request->user_id,
            ],
            [
                'course_id' => $cycle->course_id,
                'enrolled_at' => $request->enrolled_at ? Carbon::parse($request->enrolled_at) : now(),
                'expires_at' => $request->expires_at ? Carbon::parse($request->expires_at) : null,
                'status' => 'active',
            ]
        );

        return back()->with('status', 'Inscripción creada/actualizada exitosamente.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return back()->with('status', 'Inscripción eliminada correctamente.');
    }
}
