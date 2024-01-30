<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateAnimeWatchStatusResource extends JsonResource
{
   /**
    * Transform the resource into an array.
    *
    * @return array<string, mixed>
    */
   public function toArray(Request $request): array
   {
      return [
         'id' => $this->id,
         'anime_name' => $this->privateAnime->name,
         'season' => $this->season,
         'episode' => $this->episode,
         'favourite_level' => $this->favouriteLevel ? $this->favouriteLevel->level : 'none',
         'watch_status'  => $this->watchStatus->status,
         'created_by' => UserResource::make($this->user),
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
      ];
   }
}
