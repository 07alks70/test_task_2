<?php

namespace App\Domains\Cars\Services\CarService\SubServices;

use App\Domains\Cars\Models\Car;
use App\Domains\Cars\Models\CarModel;
use App\Domains\Cars\Services\CarService\Gateway\DataObjects\CarModelResponseDTO;
use App\Domains\Cars\Services\CarService\Gateway\DataObjects\CarResponseDTO;
use App\Domains\Cars\Services\CarService\Gateway\Interfaces\GatewayCarInterface;
use App\Domains\Cars\Services\CarService\Interfaces\CarSyncServiceInterface;
use App\Domains\Geo\Models\Country;
use App\Domains\Logger\Enums\LoggerTypeEnum;
use App\Domains\Logger\Services\LoggerService\LoggerServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CarSyncService implements CarSyncServiceInterface
{
    /**
     * @param GatewayCarInterface $gatewayCar
     * @param LoggerServiceInterface $loggerService
     */
    public function __construct(
        protected GatewayCarInterface    $gatewayCar,
        protected LoggerServiceInterface $loggerService,
    ) {}

    /**
     * @return void
     * @throws Throwable
     */
    public function syncCars(): void
    {
        $data = $this->gatewayCar
            ->getData();

        //Можно разбить на чанки и в несколько jobs прокинуть на несколько очередей для ускорения синхронизации
        $data->each(function (CarResponseDTO $carDTO) {
            try {
                DB::transaction(function () use ($carDTO) {
                    $countryId = Country::query()
                        ->where('name', '=', $carDTO->country)
                        ->value('id');

                    if (empty($countryId)) {
                        $countryId = Country::query()
                            ->insertGetId([
                                'name' => $carDTO->name,
                                'active' => true,
                            ]);
                    }

                    $carId = Car::query()
                        ->where('name', '=', $carDTO->name)
                        ->value('id');

                    if (empty($carId)) {
                        $carId = Car::query()
                            ->insertGetId([
                                'name' => $carDTO->name,
                                'country_id' => $countryId,
                                'active' => true,
                            ]);
                    }

                    $carDTO->models
                        ->toCollection()
                        ->each(function (CarModelResponseDTO $carModelDTO) use ($carId) {
                            $carModelQuery = CarModel::query()
                                ->where('name', '=', $carModelDTO->name)
                                ->where('car_id', '=', $carId);

                            if ($carModelQuery->doesntExist()) {
                                CarModel::query()
                                    ->insert([
                                        'name' => $carModelDTO->name,
                                        'year_from' => $carModelDTO->yearFrom,
                                        'year_to' => $carModelDTO->yearTo,
                                        'car_id' => $carId,
                                        'active' => true,
                                    ]);
                            }
                        });
                });
            } catch (Throwable $throwable) {
                $this->loggerService
                    ->writeLogThrowable(
                        $throwable,
                        LoggerTypeEnum::SYNC_CARS_WRITE_TRANSACTION_ERROR,
                    );

                Log::error($throwable);
            }
        });
    }
}
