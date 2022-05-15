<?php

namespace App\Traits;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeFilter(Builder $builder, Filter $filter): Builder
    {
        return $filter->apply($builder);
    }
}
