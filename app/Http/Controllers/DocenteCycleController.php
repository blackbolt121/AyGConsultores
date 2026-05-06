<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteCycleController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user && ($user->isTeacher() || $user->isAdmin()), 403);

        $cycles = $user->isAdmin()
            ? \App\Models\CourseCycle::with('course')->orderByDesc('starts_at')->paginate(15)
            : $user->teachingCycles()->with('course')->orderByDesc('starts_at')->paginate(15);

        return view('docente.ciclos.index', compact('cycles'));
    }
}
