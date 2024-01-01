<?php

namespace App\Policies\v1;

use App\Models\PrivateAnime;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateAnimePolicy
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
    public function view(User $user, PrivateAnime $anime): Response
    {
        return $user->id === $anime->user_id ? Response::allow() : Response::denyAsNotFound();
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
    public function update(User $user, PrivateAnime $anime): Response
    {
        return $user->id === $anime->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateAnime $anime): Response
    {
        return $user->id === $anime->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateAnime $anime): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateAnime $anime): bool
    {
        //
    }
}
