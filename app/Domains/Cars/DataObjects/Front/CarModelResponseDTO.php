<?php

namespace App\Domains\Cars\DataObjects\Front;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CarModelResponseDTO extends Data
{
    /**
     * @param string $name
     */
    public function __construct(
        #[Rule(['required', 'string'])]
        public string $name,
    ) {}
}
