<?php

use App\Http\Controllers\AvatarController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'avatar.home');
Route::view('/all', 'avatar.all_list');
Route::get('/{id}', [AvatarController::class, 'showAvatar'])->where('id', '[0-9]+');

Route::middleware('admin')->group(function () {
    Route::get('/get/list', [AvatarController::class, 'getListAvatarJson']);
    Route::get('/get/list/{id}', [AvatarController::class, 'getListJson']);

    Route::view('/store', 'avatar.admin.store_avatar');
    Route::view('/list/store', 'avatar.admin.store_lists');

    Route::post('/list/store', [AvatarController::class, 'storeAvatarList']);
    Route::post('/store', [AvatarController::class, 'storeAvatar']);

    Route::match(['get', 'post'], '/edit/{id}', [AvatarController::class, 'editAvatar']);
    Route::match(['get', 'post'], '/edit/list/{id}', [AvatarController::class, 'editAvatarList']);
    Route::delete('/sudo/delete', [AvatarController::class, 'deleteAvatar']);
});
