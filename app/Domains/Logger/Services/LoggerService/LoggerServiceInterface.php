<?php

namespace App\Domains\Logger\Services\LoggerService;

use App\Domains\Logger\Enums\LoggerTypeEnum;
use Throwable;

interface LoggerServiceInterface
{
    /**
     * @param string $message
     * @param LoggerTypeEnum $type
     * @return void
     */
    public function writeLog(string $message, LoggerTypeEnum $type): void;

    /**
     * @param Throwable $throwable
     * @param LoggerTypeEnum $type
     * @return void
     */
    public function writeLogThrowable(Throwable $throwable, LoggerTypeEnum $type): void;
}
