<?php

namespace App\Domains\Material\Providers;

use App\Domains\Material\Services\MaterialService;
use Illuminate\Support\ServiceProvider;

class MaterialServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }

    public function register(): void
    {
        $this->app->singleton(MaterialService::class, function ($app) {
            return new MaterialService();
        });
    }
}
