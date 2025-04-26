<?php

namespace App\Domains\Inventory\Enum;

enum InventoryItemStateEnum
{
    case CUSTOM;
    case IN_STOCK;
    case OUT_OF_STOCK;
    case DISCONTINUED;
    case SOLD_RETAIL;
    case SOLD_WHOLESALE;
    case SOLD_ONLINE;
    case IN_TRANSIT;
    case RETURNED_BY_CUSTOMER;
    case RETURNED_TO_SUPPLIER;
    case WASTE;
    case RESERVED_FOR_SALE;
    case ORDERED_FROM_SUPPLIER;
    case RECEIVED_FROM_SUPPLIER;
    case COMPOSED;
    case DECOMPOSED;
    case IN_TRANSIT_TO_CUSTOM;
    case IN_TRANSIT_FROM_CUSTOM;
    case IN_TRANSIT_FROM_SUPPLIER;
    case IN_TRANSIT_TO_SUPPLIER;

    public function label(): string
    {
        return match ($this) {
            self::CUSTOM => 'Custom',
            self::IN_STOCK => 'In Stock',
            self::OUT_OF_STOCK => 'Out of Stock',
            self::DISCONTINUED => 'Discontinued',
            self::SOLD_RETAIL => 'Sold Retail',
            self::SOLD_WHOLESALE => 'Sold Wholesale',
            self::SOLD_ONLINE => 'Sold Online',
            self::IN_TRANSIT => 'In Transit',
            self::RETURNED_BY_CUSTOMER => 'Returned by Customer',
            self::RETURNED_TO_SUPPLIER => 'Returned to Supplier',
            self::WASTE => 'Waste',
            self::RESERVED_FOR_SALE => 'Reserved for Sale',
            self::ORDERED_FROM_SUPPLIER => 'Ordered from Supplier',
            self::RECEIVED_FROM_SUPPLIER => 'Received from Supplier',
            self::COMPOSED => 'Composed',
            self::DECOMPOSED => 'Decomposed',
            self::IN_TRANSIT_TO_CUSTOM => 'In Transit to Custom',
            self::IN_TRANSIT_FROM_CUSTOM => 'In Transit from Custom',
            self::IN_TRANSIT_FROM_SUPPLIER => 'In Transit from Supplier',
            self::IN_TRANSIT_TO_SUPPLIER => 'In Transit to Supplier',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::CUSTOM => 'custom',
            self::IN_STOCK => 'in_stock',
            self::OUT_OF_STOCK => 'out_of_stock',
            self::DISCONTINUED => 'discontinued',
            self::SOLD_RETAIL => 'sold_retail',
            self::SOLD_WHOLESALE => 'sold_wholesale',
            self::SOLD_ONLINE => 'sold_online',
            self::IN_TRANSIT => 'in_transit',
            self::RETURNED_BY_CUSTOMER => 'returned_by_customer',
            self::RETURNED_TO_SUPPLIER => 'returned_to_supplier',
            self::WASTE => 'waste',
            self::RESERVED_FOR_SALE => 'reserved_for_sale',
            self::ORDERED_FROM_SUPPLIER => 'ordered_from_supplier',
            self::RECEIVED_FROM_SUPPLIER => 'received_from_supplier',
            self::COMPOSED => 'composed',
            self::DECOMPOSED => 'decomposed',
            self::IN_TRANSIT_TO_CUSTOM => 'in_transit_to_custom',
            self::IN_TRANSIT_FROM_CUSTOM => 'in_transit_from_custom',
            self::IN_TRANSIT_FROM_SUPPLIER => 'in_transit_from_supplier',
            self::IN_TRANSIT_TO_SUPPLIER => 'in_transit_to_supplier',
        };
    }
}
