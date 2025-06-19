<?php

namespace app\Enum;

enum PayMethodType: string
{
    case CRYPTO = 'crypto';
    case CARD = 'card';

    public static function make(string $type): PayMethodType
    {
        return match($type) {
            self::CRYPTO->value => self::CRYPTO,
            self::CARD->value => self::CARD,
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}


