<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Inventory\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'website',
        'email',
        'phone',
        'address',
        'status'
    ];
    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
