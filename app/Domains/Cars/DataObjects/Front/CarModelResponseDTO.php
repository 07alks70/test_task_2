<?php

namespace App\Domains\Cars\DataObjects\Front;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CarModelResponseDTO extends Data
{
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $name,
        #[Rule(['required', 'number'])]
        #[MapInputName('year_from')]
        #[MapOutputName('year_from')]
        public int $yearFrom,
        #[Rule(['required', 'number'])]
        #[MapInputName('year_to')]
        #[MapOutputName('year_to')]
        public int $yearTo,
    ) {
    }
}
