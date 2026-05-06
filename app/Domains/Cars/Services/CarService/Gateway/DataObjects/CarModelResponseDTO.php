<?php

namespace App\Domains\Cars\Services\CarService\Gateway\DataObjects;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CarModelResponseDTO extends Data
{
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $name,
        #[Rule(['required', 'integer'])]
        #[MapInputName('year_from')]
        public int $yearFrom,
        #[Rule(['required', 'integer'])]
        #[MapInputName('year_to')]
        public int $yearTo,
    ) {
    }
}
