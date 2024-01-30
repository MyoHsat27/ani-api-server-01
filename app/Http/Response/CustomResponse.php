<?php


namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class CustomResponse
{
   public static function success($data = null, int $statusCode = 200): JsonResponse
   {
      return self::jsonResponse('success', null, $data, $statusCode);
   }

   /**
    * Generate a JSON response.
    *
    * @param string|null $status
    * @param int $statusCode
    * @param string|null $message
    * @param mixed $data
    *
    * @return JsonResponse
    */
   public static function jsonResponse(
      string|null $status,
      string|null $message = null,
      mixed       $data = null,
      int         $statusCode = 200
   ): JsonResponse
   {
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

   public static function createdResponse($message = 'Created successfully'): JsonResponse
   {
      return self::jsonResponse('success', $message, null, 201);
   }

   public static function updatedResponse($message = 'Updated successfully'): JsonResponse
   {
      return self::jsonResponse('success', $message);
   }

   public static function deletedResponse($message = 'Deleted successfully'): JsonResponse
   {
      return self::jsonResponse('success', $message);
   }

   public static function error($message, $statusCode = 400): JsonResponse
   {
      return self::jsonResponse('error', $message, null, $statusCode);
   }

}
