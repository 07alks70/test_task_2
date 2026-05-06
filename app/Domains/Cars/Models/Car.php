<?php

namespace App\Domains\Cars\Models;

use App\Domains\Geo\Models\Country;
use App\Domains\Infrastructure\Traits\Models\ScopesDefaultTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property int $country_id
 * @property boolean $active
 * @property Country $country
 * @property Collection<int, CarModel> $car_models
 * @method static Builder active()
 */
class Car extends Model
{
    use HasFactory;
    use ScopesDefaultTrait;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
        'active',
    ];

    /**
     * @return HasMany
     */
    public function car_models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'car_id', 'id');
    }
}
