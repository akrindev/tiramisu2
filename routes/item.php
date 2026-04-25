<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// Item routes
Route::get('/', [ItemController::class, 'showThem']);
Route::get('/{id}', [ItemController::class, 'showItem']);

// admin route
Route::middleware('admin')->group(function () {
    Route::match(['get', 'post'], '/drop/store', [ItemController::class, 'storeDrop']);
    Route::get('/drop/see', [ItemController::class, 'see']);
    Route::get('/{id}/edit', [ItemController::class, 'editItem']);
    Route::post('/{id}/edit', [ItemController::class, 'editItemPost']);
    Route::delete('/{id}/hapus', [ItemController::class, 'hapusItem']);
});
