<?php

namespace App\Domains\Inventory\Enum;

enum InventoryTypeEnum
{
    case RAW_MATERIAL;
    case SERVICE;
    case FINISHED_GOOD;
    case ITEM;
    case ITEM_VARIANT;
    case WORK_IN_PROGRESS;
    case PACKAGING;
    case MAINTENANCE_SUPPLY;

    public function label(): string
    {
        return match ($this) {
            self::RAW_MATERIAL => 'Raw Material',
            self::SERVICE => 'Service',
            self::FINISHED_GOOD => 'Finished Good',
            self::ITEM => 'Item',
            self::ITEM_VARIANT => 'Item Variant',
            self::WORK_IN_PROGRESS => 'Work in Progress',
            self::PACKAGING => 'Packaging',
            self::MAINTENANCE_SUPPLY => 'Maintenance Supply',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::RAW_MATERIAL => 'raw_material',
            self::SERVICE => 'service',
            self::FINISHED_GOOD => 'finished_good',
            self::ITEM => 'item',
            self::ITEM_VARIANT => 'item_variant',
            self::WORK_IN_PROGRESS => 'work_in_progress',
            self::PACKAGING => 'packaging',
            self::MAINTENANCE_SUPPLY => 'maintenance_supply',
        };
    }
}
