<?php

namespace App\Enums;

enum StatusEnum
{
    case ACTIVE;
    case INACTIVE;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
        };
    }
}
