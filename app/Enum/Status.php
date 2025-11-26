<?php

namespace App\Enum;

enum Status : string
{
    case aberto = 'aberto';
    case andamento = 'andamento';
    case fechado = 'fechado';

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->name, self::cases());
    }

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'aberto' => self::aberto,
            'andamento' => self::andamento,
            'fechado' => self::fechado,
            default => null,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::aberto => 'Aberto',
            self::andamento => 'Em Andamento',
            self::fechado => 'Fechado',
        };
    }
}
