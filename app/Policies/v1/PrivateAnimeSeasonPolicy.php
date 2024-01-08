<?php

namespace App\Policies\v1;

use App\Models\PrivateAnimeSeason;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateAnimeSeasonPolicy
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
    public function view(User $user, PrivateAnimeSeason $privateAnimeSeason): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrivateAnimeSeason $privateAnimeSeason): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateAnimeSeason $privateAnimeSeason): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateAnimeSeason $privateAnimeSeason): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateAnimeSeason $privateAnimeSeason): bool
    {
        //
    }
}
