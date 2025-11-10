<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseContent extends Model
{
    protected $fillable = [
        'course_id','parent_id','type','title','slug','summary','body','sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(CourseContent::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(CourseContent::class, 'parent_id')->orderBy('sort_order');
    }

    /** Profundidad (0 = raíz) */
    public function getDepthAttribute(): int
    {
        $depth = 0; $node = $this;
        while ($node->parent) { $depth++; $node = $node->parent; }
        return $depth;
    }

    /**
     * Numeración tipo "1.2.3"
     * Nota: usa sort_order. Para evitar N+1, carga parent y siblings si vas a listar muchos.
     */
    public function getNumberingAttribute(): string
    {
        $segments = [];
        $node = $this;
        while ($node) {
            // posición entre hermanos según sort_order
            if ($node->parent_id) {
                $pos = $node->parent->children
                    ->sortBy('sort_order')
                    ->values()
                    ->search(fn ($c) => $c->id === $node->id);
                $segments[] = ($pos === false ? 0 : $pos + 1);
            } else {
                // raíz: posición entre raíces
                $pos = $node->course->rootContents
                    ->sortBy('sort_order')
                    ->values()
                    ->search(fn ($c) => $c->id === $node->id);
                $segments[] = ($pos === false ? 0 : $pos + 1);
            }
            $node = $node->parent;
        }
        return implode('.', array_reverse($segments));
    }

    /** Alcances útiles */
    public function scopeRoots($q) { return $q->whereNull('parent_id'); }
    public function scopeOfCourse($q, $courseId) { return $q->where('course_id', $courseId); }
}
