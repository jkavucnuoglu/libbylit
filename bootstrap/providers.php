<?php

declare(strict_types=1);

use App\Domains\Supplier\Providers\SupplierServiceProvider;
use App\Domains\Product\Providers\MaterialServiceProvider;

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\JetstreamServiceProvider;
use App\Providers\Filament\AdminPanelProvider;

use Cartalyst\Converter\Laravel\ConverterServiceProvider;


return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    FortifyServiceProvider::class,
    JetstreamServiceProvider::class,
    ConverterServiceProvider::class,

    // Domains
    SupplierServiceProvider::class,
    MaterialServiceProvider::class,
];
