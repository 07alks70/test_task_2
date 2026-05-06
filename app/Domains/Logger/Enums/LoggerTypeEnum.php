<?php

namespace App\Domains\Logger\Enums;

enum LoggerTypeEnum: string
{
    case SYNC_CARS_GET_REQUEST = 'sync-cars-get-request';
    case SYNC_CARS_INVALID_DATA = 'sync-cars-invalid-data';
    case SYNC_CARS_EMPTY_DATA = 'sync-cars-empty-data';
    case SYNC_CARS_WRITE_TRANSACTION_ERROR = 'sync-cars-write-transaction-error';
}
