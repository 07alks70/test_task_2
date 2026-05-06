<?php

namespace App\Domains\Cars\DataObjects\Front;

use App\Domains\Cars\Models\Car;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CarResponseDTO extends Data
{
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $name,
        #[Rule(['nullable', 'array'])]
        #[DataCollectionOf(CarModelResponseDTO::class)]
        public ?DataCollection $models,
    ) {
    }

    public static function fromModel(Car $car): CarResponseDTO
    {
        return new self(
            name: $car->name,
            models: new DataCollection(CarModelResponseDTO::class, $car->car_models),
        );
    }
}
