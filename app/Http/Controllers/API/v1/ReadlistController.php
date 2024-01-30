<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreReadlistRequest;
use App\Http\Requests\API\v1\UpdateReadlistRequest;
use App\Http\Resources\v1\ReadlistCollection;
use App\Http\Resources\v1\ReadlistResource;
use App\Http\Response\CustomResponse;
use App\Models\Readlist;
use App\Models\User;
use App\Repositories\FilterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReadlistController extends Controller
{
   public function __construct()
   {
      $this->authorizeResource(Readlist::class);
   }

   /**
    * Display a listing of the resource.
    */
   public function index(FilterRepository $filterRepository, User $user, Request $request): JsonResponse
   {
      // Get the initial builder with search filtering
      $query = $filterRepository->filterBySearchKeyword($user,
         Readlist::class,
         'readlists',
         ['user'],
         $request->input('search')
      );

      $readlists = $filterRepository->paginate($query, $request);

      return CustomResponse::success(new ReadlistCollection($readlists));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreReadlistRequest $request): JsonResponse
   {
      Readlist::create([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::createdResponse();
   }

   /**
    * Display the specified resource.
    */
   public function show(User $user, Readlist $readlist): JsonResponse
   {
      return CustomResponse::success(ReadlistResource::make($readlist));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdateReadlistRequest $request, User $user, Readlist $readlist): JsonResponse
   {
      $readlist->update([
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'user_id' => Auth::id(),
      ]);

      return CustomResponse::updatedResponse();
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(User $user, Readlist $readlist): JsonResponse
   {
      $readlist->delete();

      return CustomResponse::deletedResponse();
   }
}
