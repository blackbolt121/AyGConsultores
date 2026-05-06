<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'starts_at',
        'ends_at',
        'status',
        'capacity',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'capacity' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_cycle_teacher')
            ->withTimestamps();
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(CourseCycleMaterial::class, 'course_cycle_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_cycle_id', 'user_id')
            ->withPivot(['enrolled_at', 'expires_at', 'status', 'accredited_at'])
            ->withTimestamps();
    }
}
