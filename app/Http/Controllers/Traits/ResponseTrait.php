<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param array $data
     * @param int $code
     * @param array $headers
     * @return JsonResponse
     */
    public function successResponse(array $data, int $code = 200, array $headers = []): JsonResponse
    {
        return response()->json($data, $code, $headers);
    }
}
