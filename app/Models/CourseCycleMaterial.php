<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCycleMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_cycle_id',
        'course_content_id',
        'content_type',
        'body',
        'file_path',
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(CourseCycle::class, 'course_cycle_id');
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id');
    }
}
