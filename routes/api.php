<?php

declare(strict_types=1);

use App\Domains\Supplier\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;

Route::apiResource('user', ApiUserController::class)->middleware('auth:sanctum');


