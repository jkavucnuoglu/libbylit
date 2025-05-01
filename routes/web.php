<?php

declare(strict_types=1);

use App\Domains\Product\Domains\Inventory\Http\Controllers\ProductInventoryController;
use App\Domains\Product\Http\Controllers\ProductController;
use App\Domains\Supplier\Http\Controllers\SupplierController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\User\LoginLinkController;
use App\Http\Controllers\User\OauthController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'home'])->name('home');

Route::prefix('auth')->group(
    function () {
        // OAuth
        Route::get('/redirect/{provider}', [OauthController::class, 'redirect'])->name('oauth.redirect');
        Route::get('/callback/{provider}', [OauthController::class, 'callback'])->name('oauth.callback');
        // Magic Link
        Route::middleware('throttle:login-link')->group(function () {
            Route::post('/login-link', [LoginLinkController::class, 'store'])->name('login-link.store');
            Route::get('/login-link/{token}', [LoginLinkController::class, 'login'])
                ->name('login-link.login')
                ->middleware('signed');
        });
    }
);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::group([
        'prefix' => 'suppliers',
    ], function () {
        Route::get('', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::post('', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::put('{id}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    });

    Route::group([
        'prefix' => 'products',
    ], function () {
        Route::get('', [ProductController::class, 'index'])
            ->name('products.index');
        Route::get('create', [ProductController::class, 'create'])
            ->name('products.create');
        Route::post('', [ProductController::class, 'store'])
            ->name('products.store');
        Route::get('{id}', [ProductController::class, 'show'])
            ->name('products.show');
        Route::get('{id}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');
        Route::put('{id}', [ProductController::class, 'update'])
            ->name('products.update');
        Route::delete('{id}', [ProductController::class, 'destroy'])
            ->name('products.destroy');
    });


    Route::get('/rnd', [SupplierController::class, 'index'])->name('rnd.index');
    Route::get('/bom', [SupplierController::class, 'index'])->name('bom.index');

    Route::delete('/auth/destroy/{provider}', [OauthController::class, 'destroy'])->name('oauth.destroy');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    Route::resource('/subscriptions', SubscriptionController::class)
        ->names('subscriptions')
        ->only(['index', 'create', 'store', 'show']);
});
