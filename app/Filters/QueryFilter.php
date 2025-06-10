<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected Builder $builder;

    public function __construct(public SearchSetInterface $searchSet)
    {
    }

    public function apply(Builder $builder): void
    {
        $this->builder = $builder;
        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method) && isset($value)) {
                $this->$method($value);
            }
        }
    }

    protected function fields(): array
    {
//        dd ($this->searchSet);
        return array_filter(
            $this->searchSet->toArray(), function ($value) {
            return isset($value);
        }
        );
    }
}
