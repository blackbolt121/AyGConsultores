<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Course extends Model
{
    protected $fillable = [
        'title','slug','category','hours','image','excerpt','featured','description'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'hours'    => 'integer',
    ];

    // Accessor que ya tenías
    public function getImageUrlAttribute(): string
    {
        return str_starts_with($this->image ?? '', 'http')
            ? (string) $this->image
            : asset('images/'.($this->image ?? 'placeholder.png'));
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'liderazgo' => 'Liderazgo',
            'desarrollo-personal' => 'Desarrollo Personal',
            'comunicacion' => 'Comunicación',
            default => ucfirst(str_replace('-', ' ', (string) $this->category)),
        };
    }

    /** Todos los items del contenido */
    public function contents(): HasMany
    {
        return $this->hasMany(CourseContent::class)->orderBy('sort_order');
    }

    /** Raíces del índice (nivel 1: 1, 2, 3, …) */
    public function rootContents(): HasMany
    {
        return $this->hasMany(CourseContent::class)
            ->whereNull('parent_id')
            ->orderBy('sort_order');
    }

}
