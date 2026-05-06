<?php

namespace App\Domains\Cars\Models;

use App\Domains\Infrastructure\Traits\Models\ScopesDefaultTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int    $year_from
 * @property int    $year_to
 * @property int    $car_id
 * @property bool   $active
 *
 * @method static Builder active()
 */
class CarModel extends Model
{
    use HasFactory;
    use ScopesDefaultTrait;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'year_from',
        'year_to',
        'car_id',
        'active',
    ];
}
