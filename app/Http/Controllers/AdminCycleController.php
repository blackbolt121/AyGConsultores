<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCycle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminCycleController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'course_id' => ['nullable', 'integer', 'exists:courses,id'],
            'status' => ['nullable', 'string', 'in:draft,open,active,closed,archived'],

            // date inputs (Y-m-d)
            'starts_from' => ['nullable', 'date'],
            'starts_to' => ['nullable', 'date'],
            'ends_from' => ['nullable', 'date'],
            'ends_to' => ['nullable', 'date'],
        ]);

        $query = CourseCycle::query()
            ->with('course')
            ->withCount('enrollments');

        if (!empty($filters['course_id'])) {
            $query->where('course_id', $filters['course_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['starts_from'])) {
            $query->whereDate('starts_at', '>=', Carbon::parse($filters['starts_from'])->toDateString());
        }

        if (!empty($filters['starts_to'])) {
            $query->whereDate('starts_at', '<=', Carbon::parse($filters['starts_to'])->toDateString());
        }

        if (!empty($filters['ends_from'])) {
            $query->whereDate('ends_at', '>=', Carbon::parse($filters['ends_from'])->toDateString());
        }

        if (!empty($filters['ends_to'])) {
            $query->whereDate('ends_at', '<=', Carbon::parse($filters['ends_to'])->toDateString());
        }

        $cycles = $query
            ->orderByDesc('starts_at')
            ->orderByDesc('id')
            ->paginate(25)
            ->appends($request->query());

        $courses = Course::query()->orderBy('title')->get(['id', 'title', 'major_version']);
        $statuses = ['draft', 'open', 'active', 'closed', 'archived'];

        return view('admin.cycles.index', compact('cycles', 'courses', 'statuses', 'filters'));
    }
}
