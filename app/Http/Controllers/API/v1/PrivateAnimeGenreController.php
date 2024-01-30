<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateGenre;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrivateAnimeGenreController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index(User $user, PrivateAnime $privateAnime): JsonResponse
   {
      $privateGenres = $privateAnime->privateGenres()->with(['private_animes', 'user'])->get();
      return CustomResponse::success(PrivateGenreResource::collection($privateGenres));
   }

   /**
    * Store multiple genres in a manga.
    */
   public function storeMultiple(Request $request, PrivateAnime $anime): JsonResponse
   {
      $genres = array_unique($request->input('genres', []));
      $anime->privateGenres()->attach($genres);

      return CustomResponse::createdResponse();
   }

   /**
    * Update multiple genres in a manga.
    */
   public function updateMultiple(Request $request, PrivateAnime $anime): JsonResponse
   {
      $anime->privateGenres()->detach();

      $updatedGenres = array_unique($request->input('genres', []));
      $anime->privateGenres()->attach($updatedGenres);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove all genres from a manga.
    */
   public function destroyMultiple(PrivateAnime $anime): JsonResponse
   {
      $anime->privateGenres()->detach();

      return CustomResponse::deletedResponse();
   }

   /**
    * Store a single genre in a manga.
    */
   public function storeSingle(Request $request, PrivateAnime $anime): JsonResponse
   {
      $anime->privateGenres()->attach($request->genre_id);

      return CustomResponse::createdResponse();
   }

   /**
    * Remove the specified genre from a manga.
    */
   public function destroySingle(PrivateAnime $anime, PrivateGenre $genre): JsonResponse
   {
      $anime->privateGenres()->detach($genre->id);

      return CustomResponse::deletedResponse();
   }
}
