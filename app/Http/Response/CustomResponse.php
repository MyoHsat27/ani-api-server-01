<?php


namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class CustomResponse
{
    public function success($data = null, int $statusCode = 200): JsonResponse
    {
        return $this->jsonResponse('success', null, $data, $statusCode);
    }

    /**
     * Generate a JSON response.
     *
     * @param  string|null  $status
     * @param  int          $statusCode
     * @param  string|null  $message
     * @param  mixed        $data
     *
     * @return JsonResponse
     */
    public function jsonResponse(
        string|null $status,
        string|null $message = null,
        mixed $data = null,
        int $statusCode = 200
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

    public function createdResponse($message = 'Created successfully'): JsonResponse
    {
        return $this->jsonResponse('success', $message, null, 201);
    }

    public function updatedResponse($message = 'Updated successfully'): JsonResponse
    {
        return $this->jsonResponse('success', $message);
    }

    public function deletedResponse($message = 'Deleted successfully'): JsonResponse
    {
        return $this->jsonResponse('success', $message);
    }

    public function error($message, $statusCode = 400): JsonResponse
    {
        return $this->jsonResponse('error', $message, null, $statusCode);
    }

}
