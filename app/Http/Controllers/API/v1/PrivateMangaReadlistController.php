<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StorePrivateMangaReadlistRequest;
use App\Models\Readlist;
use App\Models\PrivateManga;
use App\Models\User;
use App\Http\Response\CustomResponse;
use Illuminate\Http\Request;
use App\Http\Resources\v1\ReadlistResource;
use App\Http\Resources\v1\PrivateMangaReadlistCollection;
use App\Models\PrivateMangaReadlist;

class PrivateMangaReadlistController extends Controller
{
    protected CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Readlist $readlist, Request $request)
    {
        $this->authorize('viewAny', [PrivateMangaReadlist::class, $readlist]);
        $readlist->load('privateMangas');
        $paginatedReadlistMangas = $readlist->privateMangas()->paginate(10);

        return $this->customResponse->success([
            'readlist' => new ReadlistResource($readlist),
            'mangas'   => new PrivateMangaReadlistCollection($paginatedReadlistMangas),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrivateMangaReadlistRequest $request,
        User $user,
        Readlist $readlist)
    {
        $this->authorize('create', [PrivateMangaReadlist::class, $readlist]);
        $readlist->privateMangas()->attach($request->manga_id);

        return $this->customResponse->createdResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Readlist $readlist, PrivateManga $privateManga)
    {
        $this->authorize('delete', [PrivateMangaReadlist::class, $readlist]);
        $readlist->privateMangas()->detach($privateManga);

        return $this->customResponse->deletedResponse();
    }
}
