<?php


namespace App\CustomProvider;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

trait AuthorizeActionProvider
{
    public function authorizeAction(string $action, mixed $model): void
    {
        $response = Gate::inspect($action, $model);

        if (!$response->allowed()) {
            throw new AuthorizationException($response->message(), 401);
        }
    }
}
