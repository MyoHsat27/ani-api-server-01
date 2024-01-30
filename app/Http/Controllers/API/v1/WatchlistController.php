<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreWatchlistRequest;
use App\Http\Requests\API\v1\UpdateWatchlistRequest;
use App\Http\Resources\v1\WatchlistCollection;
use App\Http\Resources\v1\WatchlistResource;
use App\Http\Response\CustomResponse;
use App\Models\User;
use App\Models\Watchlist;
use App\Repositories\FilterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WatchlistController extends Controller
{
   public function __construct()
   {
      $this->authorizeResource(Watchlist::class);
   }

   /**
    * Display a listing of the resource.
    */
   public function index(FilterRepository $filterRepository, Request $request, User $user): JsonResponse
   {
      // Get the initial builder with search filtering
      $query = $filterRepository->filterBySearchKeyword($user,
         Watchlist::class,
         'watchlists',
         ['user'],
         $request->input('search')
      );


      $watchlists = $filterRepository->paginate($query, $request);

      return CustomResponse::success(new WatchlistCollection($watchlists));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreWatchlistRequest $request): JsonResponse
   {
      Watchlist::create([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    */
   public function show(User $user, Watchlist $watchlist): JsonResponse
   {
      return CustomResponse::success(WatchlistResource::make($watchlist));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateWatchlistRequest $request, User $user, Watchlist $watchlist): JsonResponse
   {
      $watchlist->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(User $user, Watchlist $watchlist): JsonResponse
   {
      $watchlist->delete();

      return CustomResponse::deletedResponse();
   }
}
