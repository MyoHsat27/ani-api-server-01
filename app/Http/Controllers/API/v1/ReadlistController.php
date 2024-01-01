<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreReadlistRequest;
use App\Models\Readlist;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\UpdateReadlistRequest;
use App\Models\User;
use App\Http\Resources\v1\ReadlistResource;

class ReadlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return $this->jsonResponse(200,
            "success",
            null,
            ReadlistResource::collection($user->readlists)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReadlistRequest $request)
    {
        Readlist::create([
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
    public function show(User $user, Readlist $readlist)
    {
        return $this->jsonResponse(200, 'success', null, ReadlistResource::make($readlist));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReadlistRequest $request, User $user, Readlist $readlist)
    {
        $readlist->update([
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
    public function destroy(User $user, Readlist $readlist)
    {
        $readlist->delete();

        return $this->jsonResponse(200, 'success', 'Deleted successfully');
    }
}
