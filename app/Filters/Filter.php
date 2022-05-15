<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    protected Builder $builder;

    protected array $filters = [];

    public function __construct(protected Request $request)
    {
        //
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function getFilters(): array
    {
        return array_filter($this->request->only($this->filters));
    }
}
