<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'is_published',
        'type',
        'client',
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
        'is_published' => 'boolean',
        'type' => 'string',
        'client' => 'string',
        'date_start' => 'date',
        'date_end' => 'date',
    ];

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reachContent()
    {
        $content = [];

        foreach ($this->content as $block) {
            $block['text'] = $this->parseContent($block['text']);
            $content[] = $block;
        }

        return $content;
    }

    private function parseContent(string|null$text)
    {
        $text = Str::markdown($text);
        // if string tag h1, h2, h3, h4, h5, h6
        // add class="entry-description"
        return preg_replace('/<h1>/i', '<h1 class="entry-description">', $text);
    }
}
