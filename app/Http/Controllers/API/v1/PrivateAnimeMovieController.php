<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateAnimeMovieRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeMovieRequest;
use App\Http\Resources\v1\PrivateAnimeMovieCollection;
use App\Http\Resources\v1\PrivateAnimeMovieResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeMovie;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrivateAnimeMovieController extends Controller
{

   public function index(FilterRepository $filterRepository, Request $request, User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $this->authorize('viewAny', [PrivateAnimeMovie::class, $privateAnime]);

      $movies = $filterRepository->paginate($privateAnime->movies()->with(['releaseStatus', 'privateAnime'])->getQuery(), $request);

      return CustomResponse::success(new PrivateAnimeMovieCollection($movies));
   }

   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(StorePrivateAnimeMovieRequest $request,
                         User                          $user,
                         PrivateAnime                  $privateAnime): JsonResponse
   {
      $this->authorize('create', [PrivateAnimeMovie::class, $privateAnime]);
      PrivateAnimeMovie::create([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'alt_name' => $request->alt_name,
         'release_status_id' => $request->release_status_id,
         'private_anime_id' => $privateAnime->id,
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    * @throws AuthorizationException
    */
   public function show(User $user, PrivateAnime $privateAnime, PrivateAnimeMovie $movie): JsonResponse
   {
      $this->authorize('view', [PrivateAnimeMovie::class, $privateAnime, $movie]);
      $movie->load(['releaseStatus', 'privateAnime']);

      return CustomResponse::success(PrivateAnimeMovieResource::make($movie));
   }

   /**
    * Update the specified resource in storage.
    * @throws AuthorizationException
    */
   public function update(UpdatePrivateAnimeMovieRequest $request,
                          User                           $user,
                          PrivateAnime                   $privateAnime,
                          PrivateAnimeMovie              $movie): JsonResponse
   {
      $this->authorize('update', [PrivateAnimeMovie::class, $privateAnime, $movie]);
      $movie->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'alt_name' => $request->alt_name,
         'release_status_id' => $request->release_status_id,
         'private_anime_id' => $privateAnime->id,
      ]);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    * @throws AuthorizationException
    */
   public function destroy(User $user, PrivateAnime $privateAnime, PrivateAnimeMovie $movie): JsonResponse
   {
      $this->authorize('delete', [PrivateAnimeMovie::class, $privateAnime, $movie]);

      $movie->delete();

      return CustomResponse::deletedResponse();
   }
}
