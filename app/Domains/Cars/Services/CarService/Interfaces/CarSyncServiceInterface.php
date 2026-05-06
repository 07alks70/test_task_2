<?php

namespace App\Domains\Cars\Services\CarService\Interfaces;

interface CarSyncServiceInterface
{
    /**
     * @return void
     */
    public function syncCars(): void;
}
