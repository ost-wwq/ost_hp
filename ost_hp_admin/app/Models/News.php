<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'body', 'published', 'published_at',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'date',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
