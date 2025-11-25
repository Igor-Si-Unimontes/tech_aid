<?php

namespace App\Enum;

enum Priority
{
    case low;
    case medium;
    case high;

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'low' => self::low,
            'medium' => self::medium,
            'high' => self::high,
            default => null,
        };
    }
}
