<?php

namespace App\Domains\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryItem extends Model
{
    protected $fillable = [
        'type',
        'quantity',
        'price',
        'reference',
        'state',
        'notes',
        'calculated_at',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
