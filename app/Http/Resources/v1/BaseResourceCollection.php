<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Traits\PaginatableTrait;

class BaseResourceCollection extends ResourceCollection
{
    use PaginatableTrait;

    protected function addPaginationIfRequested($response, $request)
    {
        $paginate = $request->input('page', false);

        if ($paginate) {
            $response['pagination'] = $this->paginationDetails($this->resource->toArray());
        }

        return $response;
    }
}
