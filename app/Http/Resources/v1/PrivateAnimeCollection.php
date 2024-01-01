<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\Traits\PaginatableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrivateAnimeCollection extends ResourceCollection
{
    use PaginatableTrait;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'animes' => PrivateAnimeResource::collection($this->collection),
            'pagination' => $this->paginationDetails($this->resource->toArray()),
        ];
    }
}
