<?php

use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

// Forum Routes

Route::get('/', [ForumController::class, 'feed']);
Route::get('/tag/{nya}', [ForumController::class, 'byTag']);
Route::get('/cari', [ForumController::class, 'feed']);
Route::post('/cari', [ForumController::class, 'cari']);

// For auth user
Route::middleware('auth')->group(function () {
    Route::get('/baru', [ForumController::class, 'buat']);
    Route::post('/baru', [ForumController::class, 'buatSubmit']);
    Route::post('/like', [ForumController::class, 'postLike']);
    Route::post('/likereply', [ForumController::class, 'postLikeReply']);

    // komentar forum
    Route::post('/{slug}', [ForumController::class, 'comment']);
    Route::post('/{slug}/c', [ForumController::class, 'commentReply']);
    Route::delete('/{slug}/delete', [ForumController::class, 'deleteByUser']);

    // the user thread can edit his/her thread
    Route::get('/{slug}/edit', [ForumController::class, 'edit']);
    Route::post('/{slug}/edit', [ForumController::class, 'editSubmit']);

    // Admin routes
    Route::middleware('admin')->group(function () {
        // admin can delete the pinned the thread
        Route::post('/{slug}/pin', [ForumController::class, 'pinned']);
        Route::delete('/{slug}/del', [ForumController::class, 'delete']);
        Route::delete('/delete-comment', [ForumController::class, 'deleteComment']);
    });
});

Route::get('/{slug}', [ForumController::class, 'baca']);
Route::get('/kategori/{slug}', [ForumController::class, 'category']);
