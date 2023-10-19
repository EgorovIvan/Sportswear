<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case CREATE = 'CREATE';
    case FAILED = 'FAILED';
    case CONFIRMED = 'CONFIRMED';

    public static function all(): array
    {
        return [
            self::CREATE->value,
            self::FAILED->value,
            self::CONFIRMED->value,
        ];
    }
}
