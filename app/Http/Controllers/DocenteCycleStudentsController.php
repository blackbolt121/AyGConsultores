<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteCycleStudentsController extends Controller
{
    public function index(Request $request, CourseCycle $ciclo)
    {
        $user = $request->user();
        abort_unless($user && ($user->isTeacher() || $user->isAdmin()), 403);

        $enrollments = Enrollment::query()
            ->where('course_cycle_id', $ciclo->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('docente.ciclos.alumnos', [
            'cycle' => $ciclo,
            'enrollments' => $enrollments,
        ]);
    }

    public function accredit(Request $request, CourseCycle $ciclo, User $usuario)
    {
        $actor = $request->user();
        abort_unless($actor && ($actor->isTeacher() || $actor->isAdmin()), 403);

        $enrollment = Enrollment::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('user_id', $usuario->id)
            ->firstOrFail();

        $enrollment->accredited_at = now();
        $enrollment->save();

        return back()->with('status', 'Alumno acreditado correctamente.');
    }

    public function unaccredit(Request $request, CourseCycle $ciclo, User $usuario)
    {
        $actor = $request->user();
        abort_unless($actor && ($actor->isTeacher() || $actor->isAdmin()), 403);

        $enrollment = Enrollment::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('user_id', $usuario->id)
            ->firstOrFail();

        $enrollment->accredited_at = null;
        $enrollment->save();

        return back()->with('status', 'Acreditacion removida correctamente.');
    }
}
