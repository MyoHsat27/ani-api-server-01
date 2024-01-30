<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;

class PrivateGenreCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'private-genres' => PrivateGenreResource::collection($this->collection),
        ];

        return $this->addPaginationIfRequested($response, $request);
    }
}
