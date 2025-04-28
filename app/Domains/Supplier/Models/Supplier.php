<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Product\Domains\Inventory\Models\ProductInventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->tenant_id = auth()->user()->id;
        });
    }


    protected $fillable = [
        'name',
        'account_number',
        'tax_id',
        'url',
        'email',
        'phone',
        'address',
        'status'
    ];


    protected $casts = [
        'address' => 'array',
        'status' => 'boolean',
    ];

    public function inventory(): HasMany
    {
        return $this->hasMany(ProductInventory::class);
    }
}
