<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ScopeLimitData
{
    public function scopeLimitData(Builder $query, array $data): Builder
    {
        return $query->select($data);
    }
}