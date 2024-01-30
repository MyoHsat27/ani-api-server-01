<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WatchlistCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
       $response = [
          'watchlists' => WatchlistResource::collection($this->collection)
       ];
        return  $this->addPaginationIfRequested($response, $request);
    }
}
