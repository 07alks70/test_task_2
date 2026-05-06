<?php

namespace App\Domains\Cars\Services\CarService\Interfaces;

interface CarServiceInterface
{
    /**
     * @return CarCatalogInterface
     */
    public function catalog(): CarCatalogInterface;

    /**
     * @return CarSyncServiceInterface
     */
    public function synchronization(): CarSyncServiceInterface;
}
