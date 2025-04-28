<?php

use App\Domains\Supplier\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
    'name' => 'api.',
], function () {

    Route::group([
        'prefix' => 'suppliers',
        'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
        'name' => 'inventory.',
    ], function () {
        Route::get('', [SupplierController::class, 'list'])->name('index');
        Route::post('', [SupplierController::class, 'store'])->name('store');
        Route::put('{supplier}', [SupplierController::class, 'update'])->name('update');
        Route::delete('{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
    });
});
