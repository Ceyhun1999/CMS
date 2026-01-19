<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'icons',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'news_sort_field',
        'news_sort_order',
        'include_subcategories',
        'news_per_page',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'icons' => 'array',
        'include_subcategories' => 'boolean',
        'is_active' => 'boolean',
        'news_per_page' => 'integer',
        'sort_order' => 'integer',
        'parent_id' => 'integer',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'method' => null,
            ],
        ];
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
