<?php

namespace App\Domains\Logger\Services\LoggerService;

use App\Domains\Logger\Enums\LoggerTypeEnum;

interface LoggerServiceInterface
{
    public function writeLog(string $message, LoggerTypeEnum $type): void;

    public function writeLogThrowable(\Throwable $throwable, LoggerTypeEnum $type): void;
}
