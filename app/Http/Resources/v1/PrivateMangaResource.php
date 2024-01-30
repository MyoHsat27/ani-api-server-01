<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateMangaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'slug'           => $this->slug,
            'description'    => $this->description,
            'alt_name'       => $this->alt_name,
            'chapter'        => $this->chapter,
            'resource_url'   => $this->resource_url,
            'image_url'      => $this->image_url,
            'release_status' => $this->releaseStatus->status,
            'manga_type'     => $this->mangaType->type,
            'genres'         => PrivateGenreResource::collection($this->privateGenres),
            'createdBy'      => UserResource::make($this->user),
        ];
    }
}
