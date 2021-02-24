<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeUserProjects(Builder $query): Builder
    {
        return $query->where('creator_id', '=', auth()->id());
    }

    public function getExcerptAttribute()
    {
        return Str::substr($this->description, 0, 30);
    }
}
