<?php

namespace App\Domains\Cars\Services\CarService\SubServices;

use App\Domains\Cars\DataObjects\Front\CarResponseDTO;
use App\Domains\Cars\Models\Car;
use App\Domains\Cars\Services\CarService\Interfaces\CarCatalogInterface;

class CarCatalogService implements CarCatalogInterface
{
    /**
     * @return array
     */
    public function getCatalog(): array
    {
        $cars = Car::query()->paginate(10);

        return CarResponseDTO::collect($cars)->toArray();
    }
}
