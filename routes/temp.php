<?php

use App\Http\Controllers\TempDropController;
use App\Http\Controllers\TempMonsterController;
use Illuminate\Support\Facades\Route;

// create drop / item
Route::view('/drop/create', 'temp.drop.create');
Route::post('/drop/store', [TempDropController::class, 'store']);
Route::post('/drop/edit/update', [TempDropController::class, 'update']);
Route::get('/drop/edit/{id}', [TempDropController::class, 'edit']);

// ------------------------------ //

// create monster
Route::view('/monster/create', 'temp.monster.create');
Route::post('/monster/store', [TempMonsterController::class, 'store']);
Route::get('/monster/dl', [TempMonsterController::class, 'getList']);
Route::get('/monster/fetch/{id}', [TempMonsterController::class, 'fetchItem']);
Route::post('/monster/edit/update', [TempMonsterController::class, 'update']);
Route::get('/monster/edit/{id}', [TempMonsterController::class, 'edit']);

// ------------------------------ //
Route::middleware('admin')->group(function () {
    Route::view('review', 'temp.admin.review');
});
