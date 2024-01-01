<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\CustomProvider\ResponseProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\PrivateGenre;
use App\Http\Requests\API\v1\StorePrivateGenreRequest;
use App\Http\Resources\v1\PrivateGenreResource;
use App\Http\Requests\API\v1\UpdatePrivateGenreRequest;
use App\Models\User;
use App\Http\Resources\v1\PrivateGenreCollection;

class PrivateGenreController extends Controller
{
    use ResponseProvider;

    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return new PrivateGenreCollection($user->privateGenres);
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

        return $this->jsonResponse(201, "success", "Created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, PrivateGenre $privateGenre)
    {
        return $this->jsonResponse(200, "success", null, PrivateGenreResource::make($privateGenre));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdatePrivateGenreRequest $request, PrivateGenre $privateGenre)
    {
        $privateGenre->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->jsonResponse(200, "success", "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, PrivateGenre $privateGenre)
    {
        $privateGenre->delete();

        return $this->jsonResponse(200, "success", "Deleted Successfully");
    }
}
