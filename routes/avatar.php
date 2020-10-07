<?php


Route::view('/', 'avatar.home');
Route::view('/all', 'avatar.all_list');
Route::get('/{id}', 'AvatarController@showAvatar')->where('id', '[0-9]+');


Route::middleware('admin')->group(function () {
    Route::get('/get/list', 'AvatarController@getListAvatarJson');
    Route::get('/get/list/{id}', 'AvatarController@getListJson');

    Route::view('/store', 'avatar.admin.store_avatar');
    Route::view('/list/store', 'avatar.admin.store_lists');

    Route::post('/list/store', 'AvatarController@storeAvatarList');
    Route::post('/store', 'AvatarController@storeAvatar');

    Route::match(['get', 'post'], '/edit/{id}', 'AvatarController@editAvatar');
    Route::match(['get', 'post'], '/edit/list/{id}', 'AvatarController@editAvatarList');
    Route::delete('/sudo/delete', 'AvatarController@deleteAvatar');
});