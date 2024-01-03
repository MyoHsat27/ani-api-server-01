<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateAnimeMovieRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeMovieRequest;
use App\Http\Resources\v1\PrivateAnimeMovieCollection;
use App\Http\Resources\v1\PrivateAnimeMovieResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeMovie;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PrivateAnimeMovieController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct( CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    public function index(User $user, PrivateAnime $privateAnime)
    {
        return $this->customResponse->success(new PrivateAnimeMovieCollection($privateAnime->privateAnimeMovies));
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateAnimeMovieRequest $request,User $user,PrivateAnime $privateAnime)
    {
        PrivateAnimeMovie::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'description'      => $request->description,
            'alt_name'          => $request->alt_name,
            'release_status_id'=> $request->release_status_id,
            'private_anime_id' => $request->private_anime_id,
        ]);

        return $this->customResponse->createdResponse();
    }

     /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateAnime $privateAnime,PrivateAnimeMovie $privateAnimeMovie)
    {
        return $this->customResponse->success(PrivateAnimeMovieResource::make($privateAnimeMovie));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateAnimeMovieRequest $request, User $user, PrivateAnime $privateAnime,PrivateAnimeMovie $privateAnimeMovie)
    {
        $privateAnimeMovie->update([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'description'      => $request->description,
            'alt_name'          => $request->alt_name,
            'release_status_id'=> $request->release_status_id,
            'private_anime_id' => $request->private_anime_id,
        ]);

        return $this->customResponse->updatedResponse();
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,PrivateAnime $privateAnime, PrivateAnimeMovie $privateAnimeMovie)
    {
        $privateAnimeMovie->delete();

        return $this->customResponse->deletedResponse();
    }
}
