<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\PrivateGenre;
use App\Http\Requests\API\v1\StorePrivateGenreRequest;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Requests\API\v1\UpdatePrivateGenreRequest;
use App\Models\User;
use App\Http\Resources\v1\PrivateGenreCollection;
use App\Http\Response\CustomResponse;

class PrivateGenreController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return $this->customResponse->success(new PrivateGenreCollection($user->privateGenres));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, StorePrivateGenreRequest $request)
    {
        PrivateGenre::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateGenre $privateGenre)
    {
        return $this->customResponse->success(PrivateGenreResource::make($privateGenre));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user,
        UpdatePrivateGenreRequest $request,
        PrivateGenre $privateGenre)
    {
        $privateGenre->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateGenre $privateGenre)
    {
        $privateGenre->delete();

        return $this->customResponse->deletedResponse();
    }
}
