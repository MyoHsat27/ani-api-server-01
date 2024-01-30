<?php

namespace App\Repositories\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReleaseStatusFilter implements FilterInterface
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->when($value, function (Builder $query) use ($value) {
            return $query->whereHas('releaseStatus', function (Builder $subQuery) use ($value) {
                return $subQuery->where('status', $value);
            });
        });
    }
}
