<?php

namespace App\Domains\Cars\Services\CarService\Gateway\DataObjects;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CarResponseDTO extends Data
{
    /**
     * @param null|string $name
     * @param null|string $country
     * @param DataCollection|null $models
     */
    public function __construct(
        #[Rule(['nullable', 'string'])]
        public ?string     $name,
        #[Rule(['nullable', 'string'])]
        public ?string     $country,
        #[Rule(['nullable'])]
        #[DataCollectionOf(CarModelResponseDTO::class)]
        public ?DataCollection $models,
    ) {}
}
