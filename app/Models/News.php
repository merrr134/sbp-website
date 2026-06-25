<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'content',
        'image', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Scope — hanya ambil yang sudah published
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->orderBy('published_at', 'desc');
    }
}
