<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Filters\FilterFactory;

class FilterRepository
{
    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filter => $value) {
            if ($this->filterSupported($filter) && !is_null($value)) {
                $filterInstance = FilterFactory::create($filter);
                $filterInstance->apply($query, $value);
            }
        }

        return $query;
    }

    private function filterSupported(string $filter): bool
    {
        return in_array($filter, ['searchKeyword', 'chapterFrom', 'releaseStatus', 'mangaType','filterByStatus']);
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
     * Paginate the query.
     *
     * @param  Builder  $query
     * @param  Request  $request
     * @param  int      $perPage
     *
     * @return LengthAwarePaginator|Collection
     */
    public function paginate(Builder $query,
        Request $request,
        int $perPage = 10): LengthAwarePaginator|Collection
    {
        $page = $request->input('page');
        $limit = $request->input('limit', $perPage);

        return $page ? $query->paginate($limit) : $query->get();
    }
}
