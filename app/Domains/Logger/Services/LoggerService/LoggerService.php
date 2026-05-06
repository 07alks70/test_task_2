<?php

namespace App\Domains\Logger\Services\LoggerService;

use App\Domains\Logger\Enums\LoggerTypeEnum;
use App\Domains\Logger\Models\Logger;

class LoggerService implements LoggerServiceInterface
{
    public function writeLog(string $message, LoggerTypeEnum $type): void
    {
        Logger::query()
            ->insert([
                'message' => $message,
                'type' => $type->value,
            ])
        ;
    }

    public function writeLogThrowable(\Throwable $throwable, LoggerTypeEnum $type): void
    {
        Logger::query()
            ->insert([
                'message' => json_encode([
                    'error' => $throwable->getMessage(),
                    'trace' => $throwable->getTrace(),
                    'file' => $throwable->getFile(),
                    'line' => $throwable->getLine(),
                ], JSON_UNESCAPED_UNICODE),
                'type' => $type->value,
            ])
        ;
    }
}
