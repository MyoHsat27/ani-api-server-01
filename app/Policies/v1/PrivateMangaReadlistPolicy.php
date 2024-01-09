<?php

namespace App\Policies\v1;

use App\Models\PrivateMangaReadlist;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Readlist;

class PrivateMangaReadlistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Readlist $readlist): Response
    {
        return $user->id === $readlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Readlist $readlist): Response
    {
        return $user->id === $readlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Readlist $readlist): Response
    {
        return $user->id === $readlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
