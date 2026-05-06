<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'course_cycle_id',
        'enrolled_at',
        'expires_at',
        'status',
        'accredited_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'expires_at' => 'datetime',
        'accredited_at' => 'datetime',
    ];

    public function scopeAccessible($q)
    {
        return $q->where('status', 'active')
            ->where(function ($qq) {
                $qq->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseCycle()
    {
        return $this->belongsTo(CourseCycle::class);
    }
}
