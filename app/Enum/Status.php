<?php

namespace App\Enum;

enum Status
{
    case open;
    case in_progress;
    case closed;

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'open' => self::open,
            'in_progress' => self::in_progress,
            'closed' => self::closed,
            default => null,
        };
    }
}
