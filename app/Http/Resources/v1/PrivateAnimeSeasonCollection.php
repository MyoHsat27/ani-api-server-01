<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\Traits\PaginatableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrivateAnimeSeasonCollection extends BaseResourceCollection
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
            'private-anime-seasons' => PrivateAnimeSeasonResource::collection($this->collection),
        ];

        return $this->addPaginationIfRequested($response, $request);
    }
}
