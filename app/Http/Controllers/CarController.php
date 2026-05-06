<?php

namespace App\Http\Controllers;

use App\Domains\Cars\Services\CarService\Interfaces\CarServiceInterface;
use App\Http\Controllers\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    use ResponseTrait;

    protected const CACHE_VERSION = 2;
    protected const CACHE_TTL = 60;

    public function __construct(
        protected CarServiceInterface $carService,
    ) {
    }

    public function carList(Request $request): JsonResponse
    {
        $cacheKey = sprintf('cars_catalog_%s_v%s', $request->get('page', 1), self::CACHE_VERSION);

        $data = Cache::remember($cacheKey, now()->addMinutes(self::CACHE_TTL), function () {
            return $this->carService
                ->catalog()
                ->getCatalog();
        });

        return $this->successResponse($data);
    }
}
