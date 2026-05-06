<?php

namespace App\Domains\Logger\Models;

use App\Domains\Logger\Enums\LoggerTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property LoggerTypeEnum $enum
 * @property string $message
 */
class Logger extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'message',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'type' => LoggerTypeEnum::class,
    ];
}
