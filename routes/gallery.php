<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Gallery routes

Route::get('/', [GalleryController::class, 'index']);
Route::get('/{id}', [GalleryController::class, 'single'])->where('id', '[0-9]+');

Route::middleware('auth')->group(function () {
    Route::post('/', [GalleryController::class, 'upload']);
    Route::post('/{id}', [GalleryController::class, 'comment']);
    Route::get('/mygallery', [GalleryController::class, 'myGallery'])->name('mygallery');

    Route::get('/{id}/edit', [GalleryController::class, 'edit']);
    Route::post('/{id}/edit', [GalleryController::class, 'editSubmit']);
    Route::delete('/destroy', [GalleryController::class, 'destroy']);
    Route::delete('/destroy/comment', [GalleryController::class, 'destroyComment']);
});

Route::get('/tag/{tag}', [GalleryController::class, 'getByTag']);
Route::get('/by/{provider_id}', [GalleryController::class, 'getUserGallery']);
