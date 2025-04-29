<?php

namespace App\Domains\Supplier\Providers;

use App\Domains\Supplier\Services\ProductService;
use App\Domains\Supplier\Services\SupplierService;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');

    }

    public function register(): void
    {
        $this->app->singleton(SupplierService::class, function () {
            return new SupplierService();
        });
    }
}
