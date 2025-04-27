<?php

namespace App\Domains\Suppliers\Facades;

use Illuminate\Support\Facades\Facade;

class Suppliers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'supplier';
    }
}
