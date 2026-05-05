<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\CourseCycleMaterial;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function show(Request $request, CourseCycle $ciclo)
    {
        $ciclo->loadMissing([
            'course.rootContents.children.children',
            'teachers:id,name,email',
        ]);

        $materials = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->get()
            ->keyBy('course_content_id');

        return view('cycles.show', [
            'cycle' => $ciclo,
            'course' => $ciclo->course,
            'materials' => $materials,
        ]);
    }
}
