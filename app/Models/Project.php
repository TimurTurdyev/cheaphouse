<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'preview_text',
        'seo_title',
        'seo_description',
        'content',
        'date_start',
        'date_end',
    ];

    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'image' => 'string',
        'preview_text' => 'string',
        'seo_title' => 'string',
        'seo_description' => 'string',
        'content' => 'array',
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    public function projectTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProjectType::class, 'project_to_types');
    }
}
