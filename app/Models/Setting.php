<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['updated_at', 'id'];

    protected $table = 'settings';

    public function scopeGroup(Builder $query, string $name): Builder
    {
        return $query->where('group', $name);
    }
}
