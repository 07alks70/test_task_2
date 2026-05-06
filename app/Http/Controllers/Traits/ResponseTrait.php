<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function successResponse(array $data, int $code = 200, array $headers = []): JsonResponse
    {
        return response()->json($data, $code, $headers);
    }
}
