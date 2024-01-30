<?php

namespace App\Policies\v1;

use App\Models\PrivateManga;
use App\Models\PrivateMangaReadStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateMangaReadStatusPolicy
{
   /**
 * Determine whether the user can view the model.
 */
   public function view(User $user, PrivateManga $privateManga): Response
   {
      return $user->id === $privateManga->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can create models.
    */
   public function create(User $user, PrivateManga $privateManga): Response
   {
      return $user->id === $privateManga->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can update the model.
    */
   public function update(User $user, PrivateManga $privateManga, PrivateMangaReadStatus $privateMangaReadStatus): Response
   {
      return $user->id === $privateManga->user_id ? Response::allow() : Response::denyAsNotFound();
   }

   /**
    * Determine whether the user can delete the model.
    */
   public function delete(User $user, PrivateManga $privateManga): Response
   {
      return $user->id === $privateManga->user_id ? Response::allow() : Response::denyAsNotFound();
   }


}
