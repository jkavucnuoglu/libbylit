<?php
namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sku',
        'type',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
