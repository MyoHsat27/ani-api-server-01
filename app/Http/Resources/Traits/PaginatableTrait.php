<?php

namespace App\Http\Resources\Traits;

trait PaginatableTrait
{
    private function paginationDetails($paginator)
    {
        return [
            'total' => $paginator['total'],
            'per_page' => $paginator['per_page'],
            'current_page' => $paginator['current_page'],
            'last_page' => $paginator['last_page'],
            'from' => $paginator['from'],
            'to' => $paginator['to'],
            'next_page_url' => $paginator['next_page_url'],
            'prev_page_url' => $paginator['prev_page_url'],
            'first_page_url' => $paginator['first_page_url'],
            'last_page_url' => $paginator['last_page_url'],
            'links' => $paginator['links'],
        ];
    }
}
