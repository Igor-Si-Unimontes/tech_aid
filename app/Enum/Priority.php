<?php

namespace App\Enum;

enum Priority : string
{
    case baixa = 'baixa';
    case media = 'media';
    case alta = 'alta';

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'baixa' => self::baixa,
            'media' => self::media,
            'alta' => self::alta,
            default => null,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::baixa => 'Baixa',
            self::media => 'Média',
            self::alta => 'Alta',
        };
    }
}
