<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class FilterRepository
{
    /**
     * Apply filters to the query.
     *
     * @param  Builder  $query
     * @param  array    $filters
     *
     * @return Builder
     */
    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter) && !is_null($value)) {
                $this->$filter($query, $value);
            }
        }

        return $query;
    }

    /**
     * Filter by search keyword
     *
     * @param  User         $user
     * @param               $modelClass
     * @param  string       $relationName
     * @param  string|null  $search
     *
     * @return Builder|ScoutBuilder
     */
    public function filterBySearchKeyword(User $user,
        $modelClass,
        string $relationName,
        ?string $search = null): Builder|ScoutBuilder
    {
        $model = new $modelClass;

        if ($search) {
            // When Scout is used to perform the search however it returns Scout Builder
            // which limits our ability to apply additional Eloquent-specific methods and conditions for filtering.

            // To overcome this limitation, we first retrieve array of Models IDs that match the search keyword using Scout.
            $searchMatchingIds =
                $model::search($search)->where('user_id', $user->id)->get()->pluck('id');

            // Now, we retrieve the actual models based on the IDs obtained
            // This step is crucial as it transforms the Scout Builder into an Eloquent Builder,
            // allowing us to apply additional Eloquent methods, conditions, and operands.
            return $model->whereIn('id', $searchMatchingIds);
        }

        // If no search keyword is provided, we simply retrieve the user's model relation.
        // This avoids unnecessary Scout queries when not searching.
        return $user->{$relationName}()->getQuery();
    }

    /**
     * Filter by chapter from.
     *
     * @param  Builder  $query
     * @param  int      $chapterFrom
     *
     * @return Builder
     */
    public function filterByChapterFrom(Builder $query,
        int $chapterFrom): Builder
    {
        return $query->when($chapterFrom, function (Builder $query) use ($chapterFrom) {
            return $query->where('chapter', '>=', $chapterFrom);
        });
    }

    /**
     * Filter by chapter to.
     *
     * @param  Builder  $query
     * @param  int      $chapterTo
     *
     * @return Builder
     */
    public function filterByChapterTo(Builder $query,
        int $chapterTo): Builder
    {
        return $query->when($chapterTo, function (Builder $query) use ($chapterTo) {
            return $query->where('chapter', '<=', $chapterTo);
        });
    }

    /**
     * Filter by status.
     *
     * @param  Builder  $query
     * @param  string   $status
     *
     * @return Builder
     */
    public function filterByReleaseStatus(Builder $query,
        string $status): Builder
    {
        return $query->when($status, function (Builder $query) use ($status) {
            return $query->whereHas('releaseStatus', function (Builder $subQuery) use ($status) {
                return $subQuery->where('status', $status);
            });
        });
    }

    /**
     * Filter by manga type.
     *
     * @param  Builder  $query
     * @param  string   $mangaType
     *
     * @return Builder
     */
    public function filterByMangaType(Builder $query,
        string $mangaType): Builder
    {
        return $query->when($mangaType, function (Builder $query) use ($mangaType) {
            return $query->whereHas('mangaType', function (Builder $subQuery) use ($mangaType) {
                return $subQuery->where('type', $mangaType);
            });
        });
    }

    /**
     * Paginate the query.
     *
     * @param  Builder  $query
     * @param  int      $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(Builder $query, int $perPage = 10)
    {
        return $query->paginate($perPage);
    }
}
