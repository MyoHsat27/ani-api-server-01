<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePrivateAnimeWatchStatusRequest;
use App\Http\Resources\v1\PrivateAnimeWatchStatusResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeWatchStatus;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PrivateAnimeWatchStatusController extends Controller
{
   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $this->authorize('create', [PrivateAnimeWatchStatus::class, $privateAnime]);
      $exists = PrivateAnimeWatchStatus::where('user_id', Auth::id())
                                       ->where('private_anime_id', $privateAnime->id)
                                       ->exists();
      if ($exists) {
         return CustomResponse::error("Watch Status for [$privateAnime->name] already exists", 403);
      }

      PrivateAnimeWatchStatus::create([
         'season' => null,
         'episode' => 0,
         'watch_status_id' => 1,
         'favourite_level_id' => null,
         'private_anime_id' => $privateAnime->id,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    */
   public function show(User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $privateAnimeWatchStatus = $this->getAnimeAssociatedWatchStatus($privateAnime);
      if (!$privateAnimeWatchStatus) {
         return CustomResponse::error("Watch Status for [$privateAnime->name] does not exist", 404);
      }
      return CustomResponse::success(PrivateAnimeWatchStatusResource::make($privateAnimeWatchStatus));
   }

   public function getAnimeAssociatedWatchStatus(PrivateAnime $privateAnime): Model|null
   {
      return $privateAnime->watchStatuses()->where('user_id', Auth::id())->limit(1)->first();
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdatePrivateAnimeWatchStatusRequest $request, User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $privateAnimeWatchStatus = $this->getAnimeAssociatedWatchStatus($privateAnime);
      if (!$privateAnimeWatchStatus) {
         return CustomResponse::error("Watch Status for [$privateAnime->name] does not exist", 404);
      }
      $privateAnimeWatchStatus->update([
         'season' => $request->season,
         'episode' => $request->episode,
         'watch_status_id' => $request->watch_status_id,
         'favourite_level_id' => $request->favourite_level_id,
         'private_anime_id' => $privateAnime->id,
         'user_id' => Auth::id(),
      ]);
      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $privateAnimeWatchStatus = $this->getAnimeAssociatedWatchStatus($privateAnime);
      if (!$privateAnimeWatchStatus) {
         return CustomResponse::error("Watch Status for [$privateAnime->name] does not exist", 404);
      }
      $privateAnimeWatchStatus->delete();
      return CustomResponse::deletedResponse();
   }
}
