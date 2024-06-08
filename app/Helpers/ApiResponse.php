<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    /**
     * @param array<string, mixed> $data
     */
    public function ok(array $data = [], int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->success($data, $statusCode);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function success(array $data = [], int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'meta' => ['success' => true, 'errors' => []],
            'data' => $data,

        ], $statusCode);
    }

    public function error(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'meta' => ['success' => false, 'errors' => [$message]
            ]
            ], $statusCode);

    }

}
