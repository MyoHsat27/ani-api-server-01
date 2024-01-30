<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateAnimeWatchlistRequest;
use App\Http\Resources\v1\PrivateAnimeWatchlistCollection;
use App\Http\Resources\v1\WatchlistResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeWatchlist;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrivateAnimeWatchlistController extends Controller
{
   /**
    * Display a listing of the resource.
    * @throws AuthorizationException
    */
   public function index(Request $request, User $user, Watchlist $watchlist): JsonResponse
   {
      $this->authorize('viewAny', [PrivateAnimeWatchlist::class, $watchlist]);
      $watchlist->load('user', 'privateAnimes');
      $paginatedWatchlistAnimes = $watchlist->privateAnimes()->with(['user', 'privateGenres.user', 'releaseStatus'])->paginate($request->input('limit') ?? 10);

      return CustomResponse::success([
         'watchlist' => new WatchlistResource($watchlist),
         'animes' => new PrivateAnimeWatchlistCollection($paginatedWatchlistAnimes),
      ]);
   }

   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(
      StorePrivateAnimeWatchlistRequest $request,
      User                              $user,
      Watchlist                         $watchlist
   ): JsonResponse
   {
      $this->authorize('create', [PrivateAnimeWatchlist::class, $watchlist]);
      $watchlist->privateAnimes()->attach($request->anime_id);

      return CustomResponse::createdResponse();
   }

   /**
    * Remove the specified resource from storage.
    * @throws AuthorizationException
    */
   public function destroy(User $user, Watchlist $watchlist, PrivateAnime $privateAnime): JsonResponse
   {
      $this->authorize('delete', [PrivateAnimeWatchlist::class, $watchlist, $privateAnime]);
      $watchlist->privateAnimes()->detach($privateAnime);

      return CustomResponse::deletedResponse();
   }
}
