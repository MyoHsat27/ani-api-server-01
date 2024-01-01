<?php

namespace App\Policies\v1;

use App\Models\PrivateManga;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateMangaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrivateManga $manga): Response
    {
        return $user->id === $manga->user_id ? Response::allow()
            : Response::deny("Unauthorized Action", 401);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrivateManga $manga): Response
    {
        return $user->id === $manga->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateManga $manga): Response
    {
        return $user->id === $manga->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateManga $manga): Response
    {
        return $user->id === $manga->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateManga $manga): bool
    {
        //
    }
}
