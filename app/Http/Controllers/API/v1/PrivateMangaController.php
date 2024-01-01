<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\FilterRepository;
use App\Models\User;
use App\Http\Requests\API\v1\PrivateMangaFilterRequest;
use App\Models\PrivateManga;
use App\Http\Resources\v1\PrivateMangaCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\StorePrivateMangaRequest;
use App\Http\Resources\v1\PrivateMangaResource;
use App\Http\Requests\API\v1\UpdatePrivateMangaRequest;
use App\Http\Response\CustomResponse;

class PrivateMangaController extends Controller
{

    /**
     * @var FilterRepository
     */
    protected FilterRepository $filterRepository;
    protected PrivateMangaGenreController $privateMangaGenreController;
    protected CustomResponse $customResponse;

    /**
     * PrivateMangaController constructor
     */
    public function __construct(
        CustomResponse $customResponse,
        FilterRepository $filterRepository,
        PrivateMangaGenreController $privateMangaGenreController)
    {
        $this->customResponse = $customResponse;
        $this->filterRepository = $filterRepository;
        $this->privateMangaGenreController = $privateMangaGenreController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PrivateMangaFilterRequest $request, User $user)
    {
        // Get the initial builder with search filtering
        $query = $this->filterRepository->filterBySearchKeyword($user,
            PrivateManga::class,
            'privateMangas',
            $request->input('search')
        );

        // Apply Additional filters
        $filters = [
            "filterByMangaType"     => $request->input('manga-type'),
            "filterByReleaseStatus" => $request->input('status'),
            "filterByChapterFrom"   => $request->input('chapter-from'),
            "filterByChapterTo"     => $request->input('chapter-to'),
        ];

        $this->filterRepository->applyFilters($query, $filters);
        $privateMangas = $this->filterRepository->paginate($query);

        return $this->customResponse->success(new PrivateMangaCollection($privateMangas));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateMangaRequest $request)
    {
        $privateManga = PrivateManga::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'description'       => $request->description,
            'alt_name'          => $request->alt_name,
            'chapter'           => $request->chapter,
            'resource_url'      => $request->resource_url,
            'image_url'         => $request->image_url,
            'release_status_id' => $request->release_status_id,
            'manga_type_id'     => $request->manga_type_id,
            'user_id'           => Auth::id(),
        ]);
        $this->privateMangaGenreController->storeMultiple($request, $privateManga);

        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateManga $privateManga)
    {

        return $this->customResponse->success(PrivateMangaResource::make($privateManga));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateMangaRequest $request,
        User $user,
        PrivateManga $privateManga)
    {
        $privateManga->update([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'description'       => $request->description,
            'alt_name'          => $request->alt_name,
            'chapter'           => $request->chapter,
            'resource_url'      => $request->resource_url,
            'image_url'         => $request->image_url,
            'release_status_id' => $request->release_status_id,
            'manga_type_id'     => $request->manga_type_id,
            'user_id'           => Auth::id(),
        ]);

        $this->privateMangaGenreController->updateMultiple($request, $privateManga);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateManga $privateManga)
    {
        $this->privateMangaGenreController->destroyMultiple($privateManga);
        $privateManga->delete();

        return $this->customResponse->deletedResponse();
    }

}
