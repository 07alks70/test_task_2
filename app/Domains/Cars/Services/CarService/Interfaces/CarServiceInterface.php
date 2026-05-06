<?php

namespace App\Domains\Cars\Services\CarService\Interfaces;

interface CarServiceInterface
{
    public function catalog(): CarCatalogInterface;

    public function synchronization(): CarSyncServiceInterface;
}
