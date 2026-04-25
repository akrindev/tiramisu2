<?php

use App\Http\Controllers\MonsterController;
use Illuminate\Support\Facades\Route;

// Monster routes
Route::get('/', [MonsterController::class, 'index']);
Route::get('/{id}', [MonsterController::class, 'showMons']);
Route::get('/type/{name}', [MonsterController::class, 'showMonsType']);
Route::get('/unsur/{type}', [MonsterController::class, 'showMonsEl']);

// admin route
Route::middleware('admin')->group(function () {
    Route::get('/{id}/edit', [MonsterController::class, 'editMons']);
    Route::post('/{id}/edit', [MonsterController::class, 'editMobPost']);
    Route::delete('/{id}/hapus', [MonsterController::class, 'monsHapus']);
});
