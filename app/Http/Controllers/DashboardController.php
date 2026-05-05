<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $como = $request->query('como');
        $effectiveRole = $user->role;
        $modoEtiqueta = null;

        if ($como !== null) {
            abort_unless($user->isAdmin(), 403);

            $map = [
                'admin' => 'admin',
                'docente' => 'teacher',
                'alumno' => 'student',
            ];

            abort_unless(array_key_exists($como, $map), 404);

            $effectiveRole = $map[$como];
            $modoEtiqueta = $como;
        }

        if ($effectiveRole === 'admin') {
            return view('dashboards.admin', [
                'modo' => $modoEtiqueta,
            ]);
        }

        if ($effectiveRole === 'teacher') {
            $cycles = $user->teachingCycles()
                ->with('course')
                ->orderByDesc('starts_at')
                ->get();

            return view('dashboards.docente', [
                'modo' => $modoEtiqueta,
                'cycles' => $cycles,
            ]);
        }

        // student
        $enrollments = Enrollment::query()
            ->where('user_id', $user->id)
            ->with(['courseCycle.course'])
            ->orderByDesc('created_at')
            ->get();

        return view('dashboards.alumno', [
            'modo' => $modoEtiqueta,
            'enrollments' => $enrollments,
        ]);
    }
}
