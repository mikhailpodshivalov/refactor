<?php

namespace app\Enum;

enum PaymentStatusType: string
{
    case SUCCESS = 'success';
    case PROCESSING = 'processing';
    case FAILED = 'failed';

    public static function make(string $type): PaymentStatusType
    {
        return match($type) {
            self::SUCCESS->value => self::SUCCESS,
            self::PROCESSING->value => self::PROCESSING,
            self::FAILED->value => self::FAILED,
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}


