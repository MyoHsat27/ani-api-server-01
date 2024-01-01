<?php

namespace App\Http\Controllers\API\v1;

use App\CustomProvider\ResponseProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PrivateAnimeFilterRequest;
use App\Http\Requests\API\v1\StorePrivateAnimeRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeRequest;
use App\Http\Resources\v1\PrivateAnimeCollection;
use App\Http\Resources\v1\PrivateAnimeResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use Illuminate\Support\Str;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateAnimeController extends Controller
{

    protected PrivateAnimeGenreController $privateAnimeGenreController;
    protected CustomResponse $customResponse;
    /**
     * PrivateMangaController constructor
     */
    public function __construct( CustomResponse $customResponse,
        PrivateAnimeGenreController $privateAnimeGenreController)
    {
        $this->customResponse = $customResponse;
        $this->privateAnimeGenreController = $privateAnimeGenreController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(FilterRepository $filterRepository,PrivateAnimeFilterRequest $request,User $user)
    {
         // Get the initial builder with search filtering
         $query = $filterRepository->filterBySearchKeyword($user,
         PrivateAnime::class,
         'privateAnimes',
         $request->input('search')
     );

     // Apply Additional filters
     $filters = [
         'releaseStatus' => $request->input('release-status'),
     ];
     $filteredResult = $filterRepository->applyFilters($query, $filters);
     $privateAnimes = $filterRepository->paginate($filteredResult,$request);

     return $this->customResponse->success(new PrivateAnimeCollection($privateAnimes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateAnimeRequest $request)
    {
        $privateAnime = PrivateAnime::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'description'       => $request->description,
            'alt_name'          => $request->alt_name,
            'resource_url'      => $request->resource_url,
            'image_url'         => $request->image_url,
            'release_status_id' => $request->release_status_id,
            'user_id'           => Auth::id(),
        ]);
        $this->privateAnimeGenreController->storeMultiple($request, $privateAnime);

        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateAnime $privateAnime)
    {
        return $this->customResponse->success(PrivateAnimeResource::make($privateAnime));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateAnimeRequest $request,
    User $user,
    PrivateAnime $privateAnime)
{
    $privateAnime->update([
        'name'              => $request->name,
        'slug'              => Str::slug($request->name),
        'description'       => $request->description,
        'alt_name'          => $request->alt_name,
        'resource_url'      => $request->resource_url,
        'image_url'         => $request->image_url,
        'release_status_id' => $request->release_status_id,
        'user_id'           => Auth::id(),
    ]);

   return $this->customResponse->updatedResponse();


}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateAnime $privateAnime)
    {
        $this->privateAnimeGenreController->destroyMultiple($privateAnime);
        $privateAnime->delete();

        return $this->customResponse->deletedResponse();
    }
}
