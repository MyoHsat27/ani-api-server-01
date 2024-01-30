<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateAnimeSeasonRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeSeasonRequest;
use App\Http\Resources\v1\PrivateAnimeSeasonCollection;
use App\Http\Resources\v1\PrivateAnimeSeasonResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeSeason;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrivateAnimeSeasonController extends Controller
{
   /**
    * @throws AuthorizationException
    */
   public function index(FilterRepository $filterRepository, Request $request, User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $this->authorize('viewAny', [PrivateAnimeSeason::class, $privateAnime]);

      $seasons = $filterRepository->paginate($privateAnime->seasons()->with(['releaseStatus', 'privateAnime'])->getQuery(), $request);

      return CustomResponse::success(new PrivateAnimeSeasonCollection($seasons));
   }

   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(StorePrivateAnimeSeasonRequest $request,
                         User                           $user,
                         PrivateAnime                   $privateAnime): JsonResponse
   {
      $this->authorize('create', [PrivateAnimeSeason::class, $privateAnime]);
      PrivateAnimeSeason::create([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'episode' => $request->episode,
         'release_status_id' => $request->release_status_id,
         'private_anime_id' => $privateAnime->id,
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    * @throws AuthorizationException
    */
   public function show(User $user, PrivateAnime $privateAnime, PrivateAnimeSeason $season): JsonResponse
   {
      $this->authorize('view', [PrivateAnimeSeason::class, $privateAnime, $season]);
      $season->load(['releaseStatus', 'privateAnime']);

      return CustomResponse::success(PrivateAnimeSeasonResource::make($season));
   }

   /**
    * Update the specified resource in storage.
    * @throws AuthorizationException
    */
   public function update(UpdatePrivateAnimeSeasonRequest $request,
                          User                            $user,
                          PrivateAnime                    $privateAnime,
                          PrivateAnimeSeason              $season): JsonResponse
   {
      $this->authorize('update', [PrivateAnimeSeason::class, $privateAnime, $season]);
      $season->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'episode' => $request->episode,
         'release_status_id' => $request->release_status_id,
         'private_anime_id' => $privateAnime->id,
      ]);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    * @throws AuthorizationException
    */
   public function destroy(User $user, PrivateAnime $privateAnime, PrivateAnimeSeason $season): JsonResponse
   {
      $this->authorize('delete', [PrivateAnimeSeason::class, $privateAnime, $season]);
      $season->delete();

      return CustomResponse::deletedResponse();
   }
}
