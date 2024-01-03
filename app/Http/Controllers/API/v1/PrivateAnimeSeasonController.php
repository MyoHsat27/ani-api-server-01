<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateAnimeSeasonRequest;
use App\Http\Requests\API\v1\UpdatePrivateAnimeSeasonRequest;
use App\Http\Resources\v1\PrivateAnimeSeasonCollection;
use App\Http\Resources\v1\PrivateAnimeSeasonResource;
use App\Http\Response\CustomResponse;
use App\Models\PrivateAnime;
use App\Models\PrivateAnimeSeason;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PrivateAnimeSeasonController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct( CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    public function index(User $user, PrivateAnime $privateAnime)
    {
        return $this->customResponse->success(new PrivateAnimeSeasonCollection($privateAnime->privateAnimeSeasons));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateAnimeSeasonRequest $request,User $user,PrivateAnime $privateAnime)
    {
        PrivateAnimeSeason::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'description'      => $request->description,
            'episode'          => $request->episode,
            'release_status_id'=> $request->release_status_id,
            'private_anime_id' => $request->private_anime_id,
        ]);

        return $this->customResponse->createdResponse();
    }

     /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateAnime $privateAnime,PrivateAnimeSeason $privateAnimeSeason)
    {
        return $this->customResponse->success(PrivateAnimeSeasonResource::make($privateAnimeSeason));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateAnimeSeasonRequest $request, User $user, PrivateAnime $privateAnime,PrivateAnimeSeason $privateAnimeSeason)
    {
        $privateAnimeSeason->update([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'description'      => $request->description,
            'episode'          => $request->episode,
            'release_status_id'=> $request->release_status_id,
            'private_anime_id' => $request->private_anime_id,
        ]);

        return $this->customResponse->updatedResponse();
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,PrivateAnime $privateAnime, PrivateAnimeSeason $privateAnimeSeason)
    {
        $privateAnimeSeason->delete();

        return $this->customResponse->deletedResponse();
    }
}
