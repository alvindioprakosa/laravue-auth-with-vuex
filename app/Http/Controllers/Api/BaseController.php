<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * Success response method.
     *
     * @param mixed  $result
     * @param string $message
     * @return JsonResponse
     */
    public function sendResponse($result, string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => $message,
            'data' => $result,
        ], 200);
    }

    /**
     * Return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'status_code' => $code,
            'message' => $error,
            'data' => !empty($errorMessages) ? $errorMessages : null,
        ], $code);
    }
}
