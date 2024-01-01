<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateManga;
use App\Models\PrivateGenre;
use App\Models\User;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Response\CustomResponse;

class PrivateMangaGenreController extends Controller
{
    protected CustomResponse $customResponse;


    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(User $user, PrivateManga $privateManga)
    {
        return $this->customResponse->success(PrivateGenreResource::collection($privateManga->privateGenres));
    }

    /**
     * Store multiple genres in a manga.
     */
    public function storeMultiple(Request $request, PrivateManga $manga)
    {
        $genres = $request->input('genres', []);
        $manga->privateGenres()->attach($genres);
        return $this->customResponse->createdResponse();
    }

    /**
     * Update multiple genres in a manga.
     */
    public function updateMultiple(Request $request, PrivateManga $manga)
    {
        $manga->privateGenres()->detach();

        $updatedGenres = $request->input('genres', []);
        $manga->privateGenres()->attach($updatedGenres);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove all genres from a manga.
     */
    public function destroyMultiple(PrivateManga $manga)
    {
        $manga->privateGenres()->detach();

        return $this->customResponse->deletedResponse();
    }

    /**
     * Store a single genre in a manga.
     */
    public function storeSingle(Request $request, PrivateManga $manga)
    {
        $manga->privateGenres()->attach($request->genre_id);

        return $this->customResponse->createdResponse();
    }

    /**
     * Remove the specified genre from a manga.
     */
    public function destroySingle(PrivateManga $manga, PrivateGenre $genre)
    {
        $manga->privateGenres()->detach($genre->id);

        return $this->customResponse->deletedResponse();
    }
}
