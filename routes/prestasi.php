<?php

use App\Http\Controllers\EmblemController;
use Illuminate\Support\Facades\Route;

// Emblem / prestasi routes
Route::middleware('admin')->group(function () {
    Route::view('/add', 'emblem.add');
    Route::post('/add', [EmblemController::class, 'store']);
    Route::get('/{id}/edit', [EmblemController::class, 'edit']);
    Route::put('/{id}/edit', [EmblemController::class, 'editPost']);
    Route::delete('/{id}/hapus', [EmblemController::class, 'hapus']);
});

Route::get('/', [EmblemController::class, 'index']);
Route::get('/{id}', [EmblemController::class, 'show']);
Route::get('/reward/{name}', [EmblemController::class, 'byReward']);
