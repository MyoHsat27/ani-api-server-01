<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
   /**
    * The list of the inputs that are never flashed to the session on validation exceptions.
    *
    * @var array<int, string>
    */
   protected $dontFlash = [
      'current_password',
      'password',
      'password_confirmation',
   ];

   /**
    * Register the exception handling callbacks for the application.
    */
   public function register(): void
   {
      // Handle HTTP Exceptions (Such as : Route Not Found & Method Not Allowed in Route"
      $this->renderable(function (HttpException $e, $request) {
         if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
               "status" => "error",
               "message" => $e->getMessage(),
            ], $e->getStatusCode());
         }
      });

      // Handle Unauthorize HTTP Response
      $this->renderable(function (AccessDeniedHttpException $e, $request) {
         if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
               "status" => "error",
               "message" => $e->getMessage(),
            ], $e->getStatusCode());
         }
      });

   }
}
