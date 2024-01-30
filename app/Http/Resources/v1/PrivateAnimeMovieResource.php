<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateAnimeMovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'alt_name'          => $this->alt_name,
            'description'       => $this->description,
            'release_status' => $this->releaseStatus->status,
            'private_anime'  => $this->privateAnime->name,
        ];
    }
}
