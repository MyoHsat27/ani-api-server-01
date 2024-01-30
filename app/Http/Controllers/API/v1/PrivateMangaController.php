<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PrivateMangaFilterRequest;
use App\Http\Requests\API\v1\StorePrivateMangaRequest;
use App\Http\Requests\API\v1\UpdatePrivateMangaRequest;
use App\Http\Resources\v1\PrivateMangaCollection;
use App\Http\Resources\v1\PrivateMangaResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateManga;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PrivateMangaController extends Controller
{

   protected PrivateMangaGenreController $privateMangaGenreController;

   /**
    * PrivateMangaController constructor
    */
   public function __construct(
      PrivateMangaGenreController $privateMangaGenreController)
   {
      $this->authorizeResource(PrivateManga::class);
      $this->privateMangaGenreController = $privateMangaGenreController;
   }

   /**
    * Display a listing of the resource.
    */
   public function index(FilterRepository          $filterRepository,
                         PrivateMangaFilterRequest $request,
                         User                      $user): JsonResponse
   {
      // Get the initial builder with search filtering
      $query = $filterRepository->filterBySearchKeyword($user,
         PrivateManga::class,
         'privateMangas',
         ['privateGenres.user', 'user', 'releaseStatus', 'mangaType'],
         $request->input('search')
      );

      // Apply Additional filters
      $filters = [
         'chapterFrom' => $request->input('chapter-from'),
         'chapterTo' => $request->input('chapter-to'),
         'mangaType' => $request->input('manga-type'),
         'releaseStatus' => $request->input('release-status'),
      ];

      $filteredResult = $filterRepository->applyFilters($query, $filters);
      $privateMangas = $filterRepository->paginate($filteredResult, $request);

      return CustomResponse::success(new PrivateMangaCollection($privateMangas));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StorePrivateMangaRequest $request): JsonResponse
   {
      $privateManga = PrivateManga::create([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'alt_name' => $request->alt_name,
         'chapter' => $request->chapter,
         'resource_url' => $request->resource_url,
         'image_url' => $request->image_url,
         'release_status_id' => $request->release_status_id,
         'manga_type_id' => $request->manga_type_id,
         'user_id' => Auth::id(),
      ]);
      $this->privateMangaGenreController->storeMultiple($request, $privateManga);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    */
   public function show(User $user, PrivateManga $privateManga): JsonResponse
   {
      $privateManga->load(['privateGenres.user', 'releaseStatus', 'user', 'mangaType']);
      return CustomResponse::success(PrivateMangaResource::make($privateManga));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdatePrivateMangaRequest $request,
                          User                      $user,
                          PrivateManga              $privateManga)
   {
      $privateManga->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'alt_name' => $request->alt_name,
         'chapter' => $request->chapter,
         'resource_url' => $request->resource_url,
         'image_url' => $request->image_url,
         'release_status_id' => $request->release_status_id,
         'manga_type_id' => $request->manga_type_id,
         'user_id' => Auth::id(),
      ]);

      $this->privateMangaGenreController->updateMultiple($request, $privateManga);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(User $user, PrivateManga $privateManga): JsonResponse
   {
      $this->privateMangaGenreController->destroyMultiple($privateManga);
      $privateManga->delete();

      return CustomResponse::deletedResponse();
   }

}
