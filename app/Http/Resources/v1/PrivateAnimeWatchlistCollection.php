<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Traits\PaginatableTrait;

class PrivateAnimeWatchlistCollection extends ResourceCollection
{
    use PaginatableTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data'       => PrivateAnimeResource::collection($this->collection),
            'pagination' => $this->paginationDetails($this->resource->toArray()),
        ];
    }
}
