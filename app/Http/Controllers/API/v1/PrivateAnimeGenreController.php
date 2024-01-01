<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateGenre;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateAnimeGenreController extends Controller
{
    protected CustomResponse $customResponse;


    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, PrivateAnime $privateAnime)
    {
        return $this->customResponse->success(PrivateGenreResource::collection($privateAnime->privateGenres));
    }

    /**
     * Store multiple genres in a manga.
     */
    public function storeMultiple(Request $request, PrivateAnime $anime)
    {
        $genres = $request->input('genres', []);
        $anime->privateGenres()->attach($genres);

        return $this->customResponse->createdResponse();
    }
    
    /**
     * Update multiple genres in a manga.
     */
    public function updateMultiple(Request $request, PrivateAnime $anime)
    {
        $anime->privateGenres()->detach();

        $updatedGenres = $request->input('genres', []);
        $anime->privateGenres()->attach($updatedGenres);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove all genres from a manga.
     */
    public function destroyMultiple(PrivateAnime $anime)
    {
        $anime->privateGenres()->detach();

        return $this->customResponse->deletedResponse();
    }

    /**
     * Store a single genre in a manga.
     */
    public function storeSingle(Request $request, PrivateAnime $anime)
    {
        $anime->privateGenres()->attach($request->genre_id);

        return $this->customResponse->createdResponse();
    }

    /**
     * Remove the specified genre from a manga.
     */
    public function destroySingle(PrivateAnime $anime, PrivateGenre $genre)
    {
        $anime->privateGenres()->detach($genre->id);

        return $this->customResponse->deletedResponse();
    }
}
