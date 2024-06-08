<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'preview_text',
        'seo_title',
        'seo_description',
        'content',
    ];

    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'image' => 'string',
        'preview_text' => 'string',
        'seo_title' => 'string',
        'seo_description' => 'string',
        'content' => 'array',
    ];
}
