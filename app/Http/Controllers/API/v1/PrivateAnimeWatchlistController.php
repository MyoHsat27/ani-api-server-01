<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use App\Models\PrivateAnime;
use App\Models\User;
use App\Http\Response\CustomResponse;
use App\Http\Requests\API\v1\StorePrivateAnimeWatchlistRequest;
use App\Http\Resources\v1\PrivateAnimeWatchlistCollection;
use App\Http\Resources\v1\WatchlistResource;

class PrivateAnimeWatchlistController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Watchlist $watchlist)
    {
        $watchlist->load('privateAnimes');
        $paginatedWatchlistAnimes = $watchlist->privateAnimes()->paginate(10);

        return $this->customResponse->success([
            'watchlist' => new WatchlistResource($watchlist),
            'animes'   => new PrivateAnimeWatchlistCollection($paginatedWatchlistAnimes),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StorePrivateAnimeWatchlistRequest $request,
        User $user,
        Watchlist $watchlist
    ) {
        $watchlist->privateAnimes()->attach($request->anime_id);

        return $this->customResponse->createdResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Watchlist $watchlist, PrivateAnime $privateAnime)
    {
        $watchlist->privateAnimes()->detach($privateAnime);

        return $this->customResponse->deletedResponse();
    }
}
