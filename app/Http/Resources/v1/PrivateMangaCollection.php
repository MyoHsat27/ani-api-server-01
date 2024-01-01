<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Traits\PaginatableTrait;

class PrivateMangaCollection extends ResourceCollection
{
    use PaginatableTrait;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'private-mangas'     => PrivateMangaResource::collection($this->collection),
            'pagination' => $this->paginationDetails($this->resource->toArray()),
        ];
    }
}
