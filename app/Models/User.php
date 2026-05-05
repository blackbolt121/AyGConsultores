<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_TEACHER = 'teacher';
    const ROLE_STUDENT = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTeacher(): bool
    {
        return $this->role === self::ROLE_TEACHER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function teachingCycles()
    {
        return $this->belongsToMany(CourseCycle::class, 'course_cycle_teacher')
            ->withTimestamps();
    }

    public function enrolledCycles()
    {
        return $this->belongsToMany(CourseCycle::class, 'enrollments', 'user_id', 'course_cycle_id')
            ->withPivot(['enrolled_at', 'expires_at', 'status', 'accredited_at'])
            ->withTimestamps();
    }

    public function enrolledCourses()
    {
        // Legacy: enrollments are now tied to cycles; keep for compatibility if still used.
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot(['enrolled_at', 'expires_at', 'status', 'accredited_at', 'course_cycle_id'])
            ->withTimestamps();
    }
}
