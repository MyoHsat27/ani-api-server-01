<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateMangaReadStatusResource extends JsonResource
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
          'manga_name' => $this->privateManga->name,
          'chapter' => $this->chapter,
          'favourite_level' => $this->favouriteLevel ? $this->favouriteLevel->level : 'none',
          'watch_status'  => $this->watchStatus->status,
          'created_by' => UserResource::make($this->user),
          'created_at' => $this->created_at->format('d|M|Y H:i:s'),
          'updated_at' => $this->updated_at->format('d|M|Y H:i:s'),
       ];
    }
}
