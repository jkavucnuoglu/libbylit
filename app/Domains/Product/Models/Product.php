<?php

namespace App\Domains\Product\Models;

use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'upc',
        'barcode',
        'description',
        'category',
        'image',
        'price',
        'stripe_product_id',
        'stripe_price_id',
        'weight',
        'weight_unit',
        'length',
        'width',
        'height',
        'depth',
        'dimensions_unit',
        'is_active',
        'is_taxable',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'depth' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
