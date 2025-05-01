<?php

declare(strict_types=1);

use App\Domains\Supplier\Providers\SupplierServiceProvider;
use App\Domains\Supplier\Providers\ProductServiceProvider;

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\JetstreamServiceProvider;
use App\Providers\Filament\AdminPanelProvider;


return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    FortifyServiceProvider::class,
    JetstreamServiceProvider::class,

    // Domains
    SupplierServiceProvider::class,
    ProductServiceProvider::class,
];
