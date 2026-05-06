<?php

namespace App\Domains\Geo\Models;

use App\Domains\Infrastructure\Traits\Models\ScopesDefaultTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property bool   $active
 *
 * @method static Builder active()
 */
class Country extends Model
{
    use HasFactory;
    use ScopesDefaultTrait;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active',
    ];
}
