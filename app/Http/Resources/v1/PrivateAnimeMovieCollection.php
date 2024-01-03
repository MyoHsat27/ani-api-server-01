<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\Traits\PaginatableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrivateAnimeMovieCollection extends BaseResourceCollection
{
    use PaginatableTrait;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'private-anime-movies' => PrivateAnimeMovieResource::collection($this->collection),
        ];

        return $this->addPaginationIfRequested($response, $request);
    }
}
