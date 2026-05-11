<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\CourseCycleMaterial;
use App\Models\CourseCycleContentProgress;
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

        $validMaterialContentIds = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where(function ($q) {
                $q->where(function ($qq) {
                    $qq->where('content_type', 'pdf')->whereNotNull('file_path');
                })->orWhere(function ($qq) {
                    $qq->where('content_type', 'text')
                        ->whereNotNull('body')
                        ->whereRaw('TRIM(body) <> ""');
                });
            })
            ->pluck('course_content_id')
            ->unique()
            ->values();

        $total = $validMaterialContentIds->count();

        $completedCounts = CourseCycleContentProgress::query()
            ->selectRaw('user_id, COUNT(*) as cnt')
            ->where('course_cycle_id', $ciclo->id)
            ->whereNotNull('completed_at')
            ->whereIn('course_content_id', $validMaterialContentIds)
            ->groupBy('user_id')
            ->pluck('cnt', 'user_id')
            ->all();

        $progressByUser = [];
        foreach ($enrollments as $enrollment) {
            $uid = $enrollment->user_id;
            $completed = (int) ($completedCounts[$uid] ?? 0);
            $percent = $total > 0 ? (int) floor(($completed / $total) * 100) : 0;
            $progressByUser[$uid] = [
                'completed' => $completed,
                'total' => $total,
                'percent' => $percent,
            ];
        }

        return view('docente.ciclos.alumnos', [
            'cycle' => $ciclo,
            'enrollments' => $enrollments,
            'progressByUser' => $progressByUser,
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
