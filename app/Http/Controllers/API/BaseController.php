<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public static function getResponseJSON(int $status, mixed $data = null, string $message = '')
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $status);
    }

    public static function getErrorResponseJSON(int $status, string $message, mixed $error = null)
    {
        $errorResponse = [
            'status' => $status,
            'message' => $message,
            'error' => $error,
        ];

        return response()->json($errorResponse, $status);
    }
}
