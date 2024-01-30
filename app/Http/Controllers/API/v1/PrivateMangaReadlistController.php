<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateMangaReadlistRequest;
use App\Http\Resources\v1\PrivateMangaReadlistCollection;
use App\Http\Resources\v1\ReadlistResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateManga;
use App\Models\PrivateMangaReadlist;
use App\Models\Readlist;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrivateMangaReadlistController extends Controller
{
   /**
    * Display a listing of the resource.
    * @throws AuthorizationException
    */
   public function index(Request $request, User $user, Readlist $readlist): JsonResponse
   {
      $this->authorize('viewAny', [PrivateMangaReadlist::class, $readlist]);
      $readlist->load('privateMangas');
      $paginatedReadlistMangas = $readlist->privateMangas()->with(['user', 'privateGenres.user', 'releaseStatus', 'mangaType'])->paginate($request->input('limit') ?? 10);

      return CustomResponse::success([
         'readlist' => new ReadlistResource($readlist),
         'mangas' => new PrivateMangaReadlistCollection($paginatedReadlistMangas),
      ]);
   }

   /**
    * Store a newly created resource in storage.
    * @throws AuthorizationException
    */
   public function store(StorePrivateMangaReadlistRequest $request,
                         User                             $user,
                         Readlist                         $readlist): JsonResponse
   {
      $this->authorize('create', [PrivateMangaReadlist::class, $readlist]);
      $readlist->privateMangas()->attach($request->manga_id);

      return CustomResponse::createdResponse();
   }

   /**
    * Remove the specified resource from storage.
    * @throws AuthorizationException
    */
   public function destroy(User $user, Readlist $readlist, PrivateManga $privateManga): JsonResponse
   {
      $this->authorize('delete', [PrivateMangaReadlist::class, $readlist, $privateManga]);
      $readlist->privateMangas()->detach($privateManga);

      return CustomResponse::deletedResponse();
   }
}
