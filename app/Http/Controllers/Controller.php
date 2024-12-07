<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

abstract class Controller
{
    protected function successResponse(
        string $message,
        ?array $data = null,
        int    $code = ResponseCode::HTTP_OK
    ): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'errors' => null
        ])->setStatusCode($code);
    }
}
