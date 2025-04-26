<?php

use App\Domains\Inventory\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
    'name' => 'api.',
], function () {

    Route::group([
        'prefix' => 'inventory',
        'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
        'name' => 'inventory.',
    ], function () {
        Route::post('', [SupplierController::class, 'store'])->name('store');
        Route::put('{id}', [SupplierController::class, 'update'])->name('update');
        Route::delete('{id}', [SupplierController::class, 'destroy'])->name('destroy');
    });
});
