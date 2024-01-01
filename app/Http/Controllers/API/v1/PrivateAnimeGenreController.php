<?php

namespace App\Http\Controllers\API\v1;

use App\CustomProvider\ResponseProvider;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Models\PrivateAnime;
use App\Models\PrivateGenre;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateAnimeGenreController extends Controller
{
    use ResponseProvider;

    /**
     * Display a listing of the resource.
     */
    public function index(User $user, PrivateAnime $privateAnime)
    {
        return PrivateGenreResource::collection($privateAnime->privateGenres);
    }

    /**
     * Store multiple genres in a manga.
     */
    public function storeMultiple(Request $request, PrivateAnime $anime)
    {
        $genres = $request->input('genres', []);
        $anime->privateGenres()->attach($genres);

        return response()->json(['message' => 'Genres added successfully'], 201);
    }

    /**
     * Update multiple genres in a manga.
     */
    public function updateMultiple(Request $request, PrivateAnime $anime)
    {
        $anime->privateGenres()->detach();

        $updatedGenres = $request->input('genres', []);
        $anime->privateGenres()->attach($updatedGenres);

        return $this->jsonResponse(200, 'success', 'Genres updated successfully');
    }

    /**
     * Remove all genres from a manga.
     */
    public function destroyMultiple(PrivateAnime $anime)
    {
        $anime->privateGenres()->detach();

        return $this->jsonResponse(200, 'success', 'Genres removed successfully');
    }

    /**
     * Store a single genre in a manga.
     */
    public function storeSingle(Request $request, PrivateAnime $anime)
    {
        $anime->privateGenres()->attach($request->genre_id);

        return $this->jsonResponse(201, 'success', 'Created successfully');
    }

    /**
     * Remove the specified genre from a manga.
     */
    public function destroySingle(PrivateAnime $anime, PrivateGenre $genre)
    {
        $anime->privateGenres()->detach($genre->id);

        return $this->jsonResponse(200, 'success', 'Deleted successfully');
    }
}
