<?php

namespace App\Domains\Inventory\Enum;

enum InventoryItemTypeEnum
{
    case INCOMING;
    case OUTGOING;

    public function label(): string
    {
        return match ($this) {
            self::INCOMING => 'Incoming',
            self::OUTGOING => 'Outgoing',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::INCOMING => 'incoming',
            self::OUTGOING => 'outgoing',
        };
    }
}
