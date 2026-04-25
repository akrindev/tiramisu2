<?php

use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Skills routes

Route::get('/', [SkillController::class, 'index']);
Route::get('/{name}', [SkillController::class, 'show'])->where('name', '[a-zA-Z\-]+');
Route::get('/{id}', [SkillController::class, 'showId'])->where('id', '[0-9]+');
Route::get('/child/{id}', [SkillController::class, 'singleChild']);

Route::get('/{parent}/{child}', [SkillController::class, 'single']);

Route::middleware('auth')->group(function () {
    Route::post('/child/{id}', [SkillController::class, 'comment']);
});

Route::middleware(['admin'])->group(function () {
    Route::get('/e/{id}/edit', [SkillController::class, 'edit']);
    Route::post('/e/{id}/save', [SkillController::class, 'save']);
    Route::delete('/skill-delete-comment', [SkillController::class, 'deleteComment']);
});
