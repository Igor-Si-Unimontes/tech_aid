<?php

namespace App\Enum;

enum Type
{
    case admin;
    case user;
    case tech;

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'admin' => self::admin,
            'user' => self::user,
            'tech' => self::tech,
            default => null,
        };
    }
}
