<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
