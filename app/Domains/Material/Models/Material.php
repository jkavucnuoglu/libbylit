<?php

namespace App\Domains\Material\Models;

use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Rinvex\Categories\Traits\Categorizable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Material extends Model implements HasMedia
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($material) {
            $material->tenant_id = auth()->user()->id;
            $material->uuid = (string) Str::uuid();
        });
    }

    use Categorizable;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'sku',
        'upc',
        'barcode',
        'description',
        'category',
        'image',
        'price',
        'stripe_material_id',
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
        'image' => 'string',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
