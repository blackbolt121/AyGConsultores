<?php

namespace App\Http\Middleware;

use App\Models\Enrollment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCycleAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login.form');
        }

        $cycle = $request->route('ciclo') ?? $request->route('cycle');
        if (!$cycle) {
            abort(500, 'Falta el ciclo en la ruta.');
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        if ($user->isTeacher()) {
            $isAssigned = $cycle->teachers()->whereKey($user->id)->exists();
            abort_unless($isAssigned, 403, 'No tienes acceso a este ciclo.');
            return $next($request);
        }

        // Student access: must have an accessible enrollment for this cycle.
        $hasAccess = Enrollment::query()
            ->where('user_id', $user->id)
            ->where('course_cycle_id', $cycle->id)
            ->accessible()
            ->exists();

        abort_unless($hasAccess, 403, 'No tienes acceso a este ciclo.');

        return $next($request);
    }
}
