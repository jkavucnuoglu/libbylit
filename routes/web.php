<?php

declare(strict_types=1);

use App\Domains\Material\Domains\Inventory\Http\Controllers\MaterialInventoryController;
use App\Domains\Material\Http\Controllers\MaterialController;
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
        'prefix' => 'materials',
    ], function () {
        Route::get('', [MaterialController::class, 'index'])
            ->name('materials.index');
        Route::get('create', [MaterialController::class, 'create'])
            ->name('materials.create');
        Route::post('', [MaterialController::class, 'store'])
            ->name('materials.store');
        Route::get('{id}', [MaterialController::class, 'show'])
            ->name('materials.show');
        Route::get('{id}/edit', [MaterialController::class, 'edit'])
            ->name('materials.edit');
        Route::post('{id}', [MaterialController::class, 'update'])
            ->name('materials.update');
        Route::post('{id}', [MaterialController::class, 'update'])
            ->name('materials.update');

        Route::delete('{id}', [MaterialController::class, 'destroy'])
            ->name('materials.destroy');
    });


    Route::get('/rnd', [SupplierController::class, 'index'])->name('rnd.index');
    Route::get('/bom', [SupplierController::class, 'index'])->name('bom.index');

    Route::delete('/auth/destroy/{provider}', [OauthController::class, 'destroy'])->name('oauth.destroy');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

    Route::resource('/subscriptions', SubscriptionController::class)
        ->names('subscriptions')
        ->only(['index', 'create', 'store', 'show']);
});
