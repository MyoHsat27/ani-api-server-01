<?php

namespace App\Policies\v1;

use App\Models\PrivateGenre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateGenrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrivateGenre $genre): Response
    {
        return $user->id === $genre->user_id ? Response::allow() : Response::denyAsNotFound();
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
    public function update(User $user, PrivateGenre $genre): Response
    {
        return $user->id === $genre->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateGenre $genre): Response
    {
        return $user->id === $genre->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
