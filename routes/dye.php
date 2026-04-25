<?php

use App\Http\Controllers\DyeController;
use Illuminate\Support\Facades\Route;

// Dye routes
Route::get('/', [DyeController::class, 'home']);

Route::middleware('admin')->group(function () {
    Route::get('store', [DyeController::class, 'store']);
    Route::post('store', [DyeController::class, 'storeDye']);
    Route::delete('delete', [DyeController::class, 'delete']);
});
