<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadlistResource extends JsonResource
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
         'name' => $this->name,
         'slug' => $this->slug,
         'description' => $this->description,
         'created_by' => UserResource::make($this->user),
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
      ];
   }
}
