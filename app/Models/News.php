<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $table = 'news_articles';

    protected $fillable = [
        'title',
        'author',
        'slug',
        'content',
        'text',
        'image',
        'category_id',
        'read_minutes',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Scope to get only published articles
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the URL for the article
     */
    public function getUrlAttribute()
    {
        return route('article', $this->slug);
    }

    /**
     * Get the category that owns the news article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
