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
use Illuminate\Support\Str;

class PrivateAnimeSeasonController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    public function index(User $user, PrivateAnime $privateAnime)
    {
        $this->authorize('viewAny', [PrivateAnimeSeason::class, $privateAnime]);

        return $this->customResponse->success(new PrivateAnimeSeasonCollection($privateAnime->seasons
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateAnimeSeasonRequest $request,
        User $user,
        PrivateAnime $privateAnime)
    {
        $this->authorize('create', [PrivateAnimeSeason::class, $privateAnime]);
        PrivateAnimeSeason::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'description'       => $request->description,
            'episode'           => $request->episode,
            'release_status_id' => $request->release_status_id,
            'private_anime_id'  => $request->private_anime_id,
        ]);

        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateAnime $privateAnime, PrivateAnimeSeason $season)
    {
        $this->authorize('view', [PrivateAnimeSeason::class, $privateAnime]);

        return $this->customResponse->success(PrivateAnimeSeasonResource::make($season));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrivateAnimeSeasonRequest $request,
        User $user,
        PrivateAnime $privateAnime,
        PrivateAnimeSeason $season)
    {
        $this->authorize('update', [PrivateAnimeSeason::class, $privateAnime]);
        $season->update([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'description'       => $request->description,
            'episode'           => $request->episode,
            'release_status_id' => $request->release_status_id,
            'private_anime_id'  => $request->private_anime_id,
        ]);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateAnime $privateAnime, PrivateAnimeSeason $season)
    {
        $this->authorize('delete', [PrivateAnimeSeason::class, $privateAnime]);
        $season->delete();

        return $this->customResponse->deletedResponse();
    }
}
