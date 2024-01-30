<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UpdatePrivateMangaReadStatusRequest;
use App\Http\Resources\PrivateMangaReadStatusResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateManga;
use App\Models\PrivateMangaReadStatus;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PrivateMangaReadStatusController extends Controller
{
   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(User $user, PrivateManga $privateManga): JsonResponse
   {
      $this->authorize('create', [PrivateMangaReadStatus::class, $privateManga]);

      $exists = PrivateMangaReadStatus::where('user_id', Auth::id())
                                      ->where('private_manga_id', $privateManga->id)
                                      ->exists();
      if ($exists) {
         return CustomResponse::error("Read Status for [$privateManga->name] already exists", 403);
      }

      PrivateMangaReadStatus::create([
         'chapter' => 0,
         'watch_status_id' => 1,
         'favourite_level_id' => null,
         'private_manga_id' => $privateManga->id,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    */
   public function show(User $user, PrivateManga $privateManga): JsonResponse
   {
      $privateMangaReadStatus = $this->getMangaAssociatedReadStatus($privateManga);
      if (!$privateMangaReadStatus) {
         return CustomResponse::error("Read Status for [$privateManga->name] does not exist", 404);
      }
      return CustomResponse::success(PrivateMangaReadStatusResource::make($privateMangaReadStatus));
   }

   public function getMangaAssociatedReadStatus(PrivateManga $privateManga): Model|null
   {
      return $privateManga->readStatuses()->where('user_id', Auth::id())->limit(1)->first();
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdatePrivateMangaReadStatusRequest $request, User $user, PrivateManga $privateManga): JsonResponse
   {
      $privateMangaReadStatus = $this->getMangaAssociatedReadStatus($privateManga);
      if (!$privateMangaReadStatus) {
         return CustomResponse::error("Read Status for [$privateManga->name] does not exist", 404);
      }
      $privateMangaReadStatus->update([
         'chapter' => $request->chapter,
         'watch_status_id' => $request->watch_status_id,
         'favourite_level_id' => $request->favourite_level_id,
         'private_manga_id' => $privateManga->id,
         'user_id' => Auth::id(),
      ]);
      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(User $user, PrivateManga $privateManga): JsonResponse
   {
      $privateMangaReadStatus = $this->getMangaAssociatedReadStatus($privateManga);
      if (!$privateMangaReadStatus) {
         return CustomResponse::error("Read Status for [$privateManga->name] does not exist", 404);
      }

      $privateMangaReadStatus->delete();
      return CustomResponse::deletedResponse();
   }
}
