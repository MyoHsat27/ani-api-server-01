<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

class MangaTypeFilter implements FilterInterface
{
    public function apply(Builder $query,
        $value): Builder
    {
        return $query->when($value, function (Builder $query) use ($value) {
            return $query->whereHas('mangaType', function (Builder $subQuery) use ($value) {
                return $subQuery->where('type', $value);
            });
        });

    }
}