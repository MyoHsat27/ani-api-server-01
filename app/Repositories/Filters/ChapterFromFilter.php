<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

class ChapterFromFilter implements FilterInterface
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->when($value, function (Builder $query) use ($value) {
            return $query->where('chapter', '>=', $value);
        });
    }
}
