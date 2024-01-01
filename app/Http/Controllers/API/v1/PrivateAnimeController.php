<?php

namespace App\Http\Controllers\API\v1;

use App\CustomProvider\ResponseProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PrivateAnimeFilterRequest;
use App\Http\Requests\API\v1\StorePrivateAnimeRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeRequest;
use App\Http\Resources\v1\PrivateAnimeCollection;
use App\Http\Resources\v1\PrivateAnimeResource;
use App\Models\PrivateAnime;
use Illuminate\Support\Str;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateAnimeController extends Controller
{
    use ResponseProvider;

    /**
     * @var FilterRepository
     */
    protected FilterRepository $filterRepository;
    protected PrivateAnimeGenreController $privateAnimeGenreController;

    /**
     * PrivateMangaController constructor
     */
    public function __construct(FilterRepository $filterRepository,
        PrivateAnimeGenreController $privateAnimeGenreController)
    {
        $this->filterRepository = $filterRepository;
        $this->privateAnimeGenreController = $privateAnimeGenreController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PrivateAnimeFilterRequest $request,User $user)
    {
         // Get the initial builder with search filtering
         $query = $this->filterRepository->filterBySearchKeyword($user,
         PrivateAnime::class,
         'privateAnimes',
         $request->input('search')
     );

     // Apply Additional filters
     $filters = [
         "filterByStatus" => $request->input('status'),
     ];
     $this->filterRepository->applyFilters($query, $filters);
     $animes = $this->filterRepository->paginate($query);

     return new PrivateAnimeCollection($animes);
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

        return $this->jsonResponse(201, "success", "Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateAnime $privateAnime)
    {
        return $this->jsonResponse(200, "success", null, PrivateAnimeResource::make($privateAnime));
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

    $this->privateAnimeGenreController->updateMultiple($request, $privateAnime);

    return $this->jsonResponse(200, "success", "Updated Successfully");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateAnime $privateAnime)
    {
        $this->privateAnimeGenreController->destroyMultiple($privateAnime);
        $privateAnime->delete();

        return $this->jsonResponse(200, "success", "Deleted Successfully");
    }
}
