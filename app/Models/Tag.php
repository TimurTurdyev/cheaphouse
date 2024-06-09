<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'is_published',
    ];

    protected $casts = [
        'name' => 'string',
        'is_published' => 'boolean',
    ];

    public $timestamps = false;

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
