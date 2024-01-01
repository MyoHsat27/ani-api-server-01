<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreWatchlistRequest;
use App\Models\Watchlist;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\UpdateWatchlistRequest;
use App\Models\User;
use App\Http\Resources\v1\WatchlistResource;
use App\Http\Resources\v1\WatchlistCollection;
use App\Http\Response\CustomResponse;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FilterRepository $filterRepository, Request $request, User $user)
    {
        // Get the initial builder with search filtering
        $query = $filterRepository->filterBySearchKeyword($user,
            Watchlist::class,
            'watchlists',
            $request->input('search')
        );

        $watchlists = $filterRepository->paginate($query, $request);

        return $this->customResponse->success(new WatchlistCollection($watchlists));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchlistRequest $request)
    {
        Watchlist::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Watchlist $watchlist)
    {
        return $this->customResponse->success(WatchlistResource::make($watchlist));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWatchlistRequest $request, User $user, Watchlist $watchlist)
    {
        $watchlist->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Watchlist $watchlist)
    {
        $watchlist->delete();

        return $this->customResponse->deletedResponse();
    }
}
