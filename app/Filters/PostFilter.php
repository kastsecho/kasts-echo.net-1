<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends Filter
{
    protected array $filters = ['category'];

    public function category(string $value): Builder
    {
        return match ($value) {
            'all' => $this->builder,
            default => $this->builder->whereRelation('category', 'slug', $value),
        };
    }
}
