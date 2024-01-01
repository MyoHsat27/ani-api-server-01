<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreWatchlistRequest;
use App\Models\Watchlist;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\UpdateWatchlistRequest;
use App\Models\User;
use App\Http\Resources\v1\WatchlistResource;
use App\CustomProvider\ResponseProvider;
use App\Http\Resources\v1\WatchlistCollection;

class WatchlistController extends Controller
{
    use ResponseProvider;

    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return new WatchlistCollection($user->watchlists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchlistRequest $request)
    {
        Watchlist::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->jsonResponse(201, 'success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Watchlist $watchlist)
    {
        return $this->jsonResponse(200, 'success', null, WatchlistResource::make($watchlist));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWatchlistRequest $request, User $user, Watchlist $watchlist)
    {
        $watchlist->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        return $this->jsonResponse(200, 'success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Watchlist $watchlist)
    {
        $watchlist->delete();

        return $this->jsonResponse(200, 'success', 'Deleted successfully');
    }
}
