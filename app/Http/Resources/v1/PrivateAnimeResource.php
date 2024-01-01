<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateAnimeResource extends JsonResource
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
            'resource_url'   => $this->resource_url,
            'image_url'      => $this->image_url,
            'release_status' => $this->releaseStatus->status,
            'genres'         => $this->privateGenres->pluck('name'),
            'createdBy'      => $this->user->username,
        ];
    }
}
