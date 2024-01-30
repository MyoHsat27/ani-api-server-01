<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateGenre;
use App\Models\PrivateManga;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrivateMangaGenreController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index(User $user, PrivateManga $privateManga): JsonResponse
   {
      $privateGenres = $privateManga->privateGenres()->with(['private_mangas', 'user'])->get();
      return CustomResponse::success(PrivateGenreResource::collection($privateGenres));
   }

   /**
    * Store multiple genres in a manga.
    */
   public function storeMultiple(Request $request, PrivateManga $manga): JsonResponse
   {
      $genres = array_unique($request->input('genres', []));
      $manga->privateGenres()->attach($genres);

      return CustomResponse::createdResponse();
   }

   /**
    * Update multiple genres in a manga.
    */
   public function updateMultiple(Request $request, PrivateManga $manga): JsonResponse
   {
      $manga->privateGenres()->detach();

      $updatedGenres = array_unique($request->input('genres', []));
      $manga->privateGenres()->attach($updatedGenres);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove all genres from a manga.
    */
   public function destroyMultiple(PrivateManga $manga): JsonResponse
   {
      $manga->privateGenres()->detach();

      return CustomResponse::deletedResponse();
   }

   /**
    * Store a single genre in a manga.
    */
   public function storeSingle(Request $request, PrivateManga $manga): JsonResponse
   {
      $manga->privateGenres()->attach($request->genre_id);

      return CustomResponse::createdResponse();
   }

   /**
    * Remove the specified genre from a manga.
    */
   public function destroySingle(PrivateManga $manga, PrivateGenre $genre): JsonResponse
   {
      $manga->privateGenres()->detach($genre->id);

      return CustomResponse::deletedResponse();
   }
}
