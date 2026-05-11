<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCycleContentProgress extends Model
{
    protected $table = 'course_cycle_content_progress';

    protected $fillable = [
        'user_id',
        'course_cycle_id',
        'course_content_id',
        'active_seconds',
        'last_heartbeat_at',
        'completed_at',
        'pdf_total_pages',
        'pdf_reached_last_page_at',
    ];

    protected $casts = [
        'active_seconds' => 'integer',
        'last_heartbeat_at' => 'datetime',
        'completed_at' => 'datetime',
        'pdf_total_pages' => 'integer',
        'pdf_reached_last_page_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(CourseCycle::class, 'course_cycle_id');
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id');
    }
}
