<?php

namespace App\Providers;

use App\Domains\Cars\Services\CarService\CarService;
use App\Domains\Cars\Services\CarService\Gateway\Interfaces\GatewayCarInterface;
use App\Domains\Cars\Services\CarService\Gateway\Services\ApiCarBase\ApiCarBase;
use App\Domains\Cars\Services\CarService\Interfaces\CarServiceInterface;
use App\Domains\Logger\Services\LoggerService\LoggerService;
use App\Domains\Logger\Services\LoggerService\LoggerServiceInterface;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(LoggerServiceInterface::class, function () {
                return new LoggerService();
            })
        ;

        $this->app
            ->bind(GatewayCarInterface::class, function () {
                $loggerService = Container::getInstance()
                    ->get(LoggerServiceInterface::class)
                ;

                return new ApiCarBase($loggerService);
            })
        ;

        $this->app
            ->singleton(CarServiceInterface::class, function () {
                $carGatewayService = Container::getInstance()
                    ->get(GatewayCarInterface::class)
                ;
                $loggerService = Container::getInstance()
                    ->get(LoggerServiceInterface::class)
                ;

                return new CarService($carGatewayService, $loggerService);
            })
        ;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
