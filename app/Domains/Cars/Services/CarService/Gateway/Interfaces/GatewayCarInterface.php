<?php

namespace App\Domains\Cars\Services\CarService\Gateway\Interfaces;

use App\Domains\Cars\Services\CarService\Gateway\DataObjects\CarResponseDTO;
use Illuminate\Support\Collection;

interface GatewayCarInterface
{
    /**
     * @return Collection<int, CarResponseDTO>
     */
    public function getData(): Collection;
}
