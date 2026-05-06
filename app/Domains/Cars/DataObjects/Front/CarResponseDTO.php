<?php

namespace App\Domains\Cars\DataObjects\Front;

use App\Domains\Cars\Models\Car;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CarResponseDTO extends Data
{
    /**
     * @param string $name
     */
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $name,
    ) {}

    /**
     * @param Car $car
     * @return self
     */
    public static function fromModel(Car $car): CarResponseDTO
    {
        return new self(
            name: $car->name,
        );
    }
}
