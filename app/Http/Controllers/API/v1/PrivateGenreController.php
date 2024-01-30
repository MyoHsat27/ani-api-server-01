<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateGenreRequest;
use App\Http\Requests\API\v1\UpdatePrivateGenreRequest;
use App\Http\Resources\v1\PrivateGenreCollection;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateGenre;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PrivateGenreController extends Controller
{
   public function __construct()
   {
      $this->authorizeResource(PrivateGenre::class);
   }

   /**
    * Display a listing of the resource.
    */
   public function index(FilterRepository $filterRepository, User $user, Request $request): JsonResponse
   {
      $privateGenres = $filterRepository->paginate($user->privateGenres()->with(['user'])->getQuery(), $request);
      return CustomResponse::success(new PrivateGenreCollection($privateGenres));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(User $user, StorePrivateGenreRequest $request): JsonResponse
   {
      PrivateGenre::create([
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
   public function show(User $user, PrivateGenre $privateGenre): JsonResponse
   {
      return CustomResponse::success(PrivateGenreResource::make($privateGenre));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(User                      $user,
                          UpdatePrivateGenreRequest $request,
                          PrivateGenre              $privateGenre): JsonResponse
   {
      $privateGenre->update([
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
   public function destroy(User $user, PrivateGenre $privateGenre): JsonResponse
   {
      $privateGenre->delete();

      return CustomResponse::deletedResponse();
   }
}
