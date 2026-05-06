<?php

namespace App\Domains\Cars\Services\CarService;

use App\Domains\Cars\Services\CarService\Gateway\Interfaces\GatewayCarInterface;
use App\Domains\Cars\Services\CarService\Interfaces\CarCatalogInterface;
use App\Domains\Cars\Services\CarService\Interfaces\CarServiceInterface;
use App\Domains\Cars\Services\CarService\Interfaces\CarSyncServiceInterface;
use App\Domains\Cars\Services\CarService\SubServices\CarCatalogService;
use App\Domains\Cars\Services\CarService\SubServices\CarSyncService;
use App\Domains\Logger\Services\LoggerService\LoggerServiceInterface;

class CarService implements CarServiceInterface
{
    public function __construct(
        protected GatewayCarInterface $gatewayCar,
        protected LoggerServiceInterface $loggerService,
    ) {
    }

    public function catalog(): CarCatalogInterface
    {
        return new CarCatalogService();
    }

    public function synchronization(): CarSyncServiceInterface
    {
        return new CarSyncService($this->gatewayCar, $this->loggerService);
    }
}
