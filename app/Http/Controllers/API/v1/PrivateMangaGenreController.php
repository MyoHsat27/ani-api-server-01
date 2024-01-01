<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateManga;
use App\Models\PrivateGenre;
use App\Models\User;
use App\CustomProvider\ResponseProvider;
use App\Http\Resources\v1\PrivateGenreResource;

class PrivateMangaGenreController extends Controller
{
    use ResponseProvider;

    /**
     * Display a listing of the resource.
     */
    public function index(User $user, PrivateManga $privateManga)
    {
        return PrivateGenreResource::collection($privateManga->privateGenres);
    }

    /**
     * Store multiple genres in a manga.
     */
    public function storeMultiple(Request $request, PrivateManga $manga)
    {
        $genres = $request->input('genres', []);
        $manga->privateGenres()->attach($genres);

        return response()->json(['message' => 'Genres added successfully'], 201);
    }

    /**
     * Update multiple genres in a manga.
     */
    public function updateMultiple(Request $request, PrivateManga $manga)
    {
        $manga->privateGenres()->detach();

        $updatedGenres = $request->input('genres', []);
        $manga->privateGenres()->attach($updatedGenres);

        return $this->jsonResponse(200, 'success', 'Genres updated successfully');
    }

    /**
     * Remove all genres from a manga.
     */
    public function destroyMultiple(PrivateManga $manga)
    {
        $manga->privateGenres()->detach();

        return $this->jsonResponse(200, 'success', 'Genres removed successfully');
    }

    /**
     * Store a single genre in a manga.
     */
    public function storeSingle(Request $request, PrivateManga $manga)
    {
        $manga->privateGenres()->attach($request->genre_id);

        return $this->jsonResponse(201, 'success', 'Created successfully');
    }

    /**
     * Remove the specified genre from a manga.
     */
    public function destroySingle(PrivateManga $manga, PrivateGenre $genre)
    {
        $manga->privateGenres()->detach($genre->id);

        return $this->jsonResponse(200, 'success', 'Deleted successfully');
    }
}
