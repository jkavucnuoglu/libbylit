<?php

namespace App\Domains\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'type',
        'quantity',
        'price',
        'image',
        'category',
        'status',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }
}
