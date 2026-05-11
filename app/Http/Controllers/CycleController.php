<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\CourseCycleMaterial;
use App\Models\CourseCycleContentProgress;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    public function show(Request $request, CourseCycle $ciclo)
    {
        $user = $request->user();
        abort_unless($user, 403);

        $ciclo->loadMissing([
            'course.rootContents.children.children',
            'teachers:id,name,email',
        ]);

        $materials = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->get()
            ->keyBy('course_content_id');

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

        $completedContentIds = CourseCycleContentProgress::query()
            ->where('user_id', $user->id)
            ->where('course_cycle_id', $ciclo->id)
            ->whereNotNull('completed_at')
            ->whereIn('course_content_id', $validMaterialContentIds)
            ->pluck('course_content_id')
            ->all();

        $completed = count($completedContentIds);
        $percent = $total > 0 ? (int) floor(($completed / $total) * 100) : 0;

        return view('cycles.show', [
            'cycle' => $ciclo,
            'course' => $ciclo->course,
            'materials' => $materials,
            'progressTotal' => $total,
            'progressCompleted' => $completed,
            'progressPercent' => $percent,
            'completedContentIds' => array_fill_keys($completedContentIds, true),
        ]);
    }
}
