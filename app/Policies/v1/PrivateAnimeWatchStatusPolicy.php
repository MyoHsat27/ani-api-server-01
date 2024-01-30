<?php

namespace App\Policies\v1;

use App\Models\PrivateAnime;
use App\Models\PrivateAnimeWatchStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateAnimeWatchStatusPolicy
{
   /**
    * Determine whether the user can view the model.
    */
   public function view(User $user, PrivateAnime $privateAnime): Response
   {
      return $user->id === $privateAnime->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can create models.
    */
   public function create(User $user, PrivateAnime $privateAnime): Response
   {
      return $user->id === $privateAnime->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can update the model.
    */
   public function update(User $user, PrivateAnime $privateAnime, PrivateAnimeWatchStatus $privateAnimeWatchStatus): Response
   {
      return $user->id === $privateAnime->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can delete the model.
    */
   public function delete(User $user, PrivateAnime $privateAnime): Response
   {
      return $user->id === $privateAnime->user_id ? Response::allow() : Response::denyAsNotFound();
   }


}
