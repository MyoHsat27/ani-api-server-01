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
use App\Http\Resources\v1\ReadlistCollection;
use App\Http\Response\CustomResponse;

class ReadlistController extends Controller
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
        return $this->customResponse->success(new ReadlistCollection($user->readlists));
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
        return $this->customResponse->createdResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Readlist $readlist)
    {
        return $this->customResponse->success(ReadlistResource::make($readlist));
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

        return $this->customResponse->updatedResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Readlist $readlist)
    {
        $readlist->delete();

        return $this->customResponse->deletedResponse();
    }
}
