<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;

class PrivateAnimeCollection extends BaseResourceCollection
{
   /**
    * Transform the resource collection into an array.
    *
    * @return array<int|string, mixed>
    */
   public function toArray(Request $request): array
   {
      $response = [
         'animes' => PrivateAnimeResource::collection($this->collection)
      ];

      return $this->addPaginationIfRequested($response, $request);
   }
}
