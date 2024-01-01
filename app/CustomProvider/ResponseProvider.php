<?php


namespace App\CustomProvider;

use Illuminate\Http\JsonResponse;

trait ResponseProvider
{
    /**
     * Generate a JSON response.
     *
     * @param  int          $statusCode
     * @param  string|null  $status
     * @param  string|null  $message
     * @param  mixed|null   $data
     *
     * @return JsonResponse
     */
    public function jsonResponse(
        int $statusCode,
        ?string $status = null,
        ?string $message = null,
        mixed $data = null
    ): JsonResponse {
        $responseData = [];

        if (!is_null($status)) {
            $responseData['status'] = $status;
        }
        if (!is_null($data)) {
            $responseData['data'] = $data;
        }
        if (!is_null($message)) {
            $responseData['message'] = $message;
        }

        return response()->json($responseData, $statusCode);
    }

    /**
     * Generate a JSON response.
     *
     * @param  string      $message
     * @param  mixed|null  $data
     *
     * @return JsonResponse
     */
    public function successResponse(string $message, mixed $data): JsonResponse
    {
        $responseData = ['message' => $message];
        if (!is_null($data)) {
            $responseData['data'] = $data;
        }

        return response()->json($responseData);
    }

}
