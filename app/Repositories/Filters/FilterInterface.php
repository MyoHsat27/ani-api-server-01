<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $query, $value): Builder;
}