<?php

use App\Http\Controllers\CookingController;
use Illuminate\Support\Facades\Route;

// Cooking Routes
Route::redirect('/', '/cooking/berteman');
Route::view('/berteman', 'cooking.tukar');
Route::get('buff', [CookingController::class, 'buff']);

Route::middleware('admin')->group(function () {
    Route::view('/store', 'cooking.store');
    Route::post('/store', [CookingController::class, 'store']);
    Route::delete('/delete/{id}', [CookingController::class, 'delete']);
});
