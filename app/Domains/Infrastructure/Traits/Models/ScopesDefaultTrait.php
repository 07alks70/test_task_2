<?php

namespace App\Domains\Infrastructure\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait ScopesDefaultTrait
{
    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
