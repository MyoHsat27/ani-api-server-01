<?php

namespace App\Policies\v1;

use App\Models\PrivateAnimeWatchlist;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Auth\Access\Response;

class PrivateAnimeWatchlistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Watchlist $watchlist): Response
    {
        return $user->id === $watchlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Watchlist $watchlist): Response
    {
        return $user->id === $watchlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Watchlist $watchlist): Response
    {
        return $user->id === $watchlist->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
