<?php

namespace App\Domains\Inventory\Providers;

use App\Domains\Inventory\Http\Controllers\SupplierController;
use App\Domains\Inventory\Http\Controllers\InventoryItemController;
use App\Domains\Inventory\Services\SupplierService;
use Illuminate\Routing\Route;
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
