<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use App\Http\Resources\Traits\PaginatableTrait;

class ReadlistCollection extends BaseResourceCollection
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
            'readlists' => ReadlistResource::collection($this->collection),
        ];

        return $this->addPaginationIfRequested($response, $request);
    }
}
