<?php

// Admin Routes
Route::get('/', 'AdminController@home');
Route::get('/users', 'AdminController@users');
Route::get('/last-login', 'AdminController@lastLogin');
Route::get('/searches', 'AdminController@logSearches');
Route::get('/last_forum_posts', 'AdminController@lastThread');

Route::put('/change-user', 'AdminController@changeUser');
Route::post('/tagforum', 'AdminController@tagForum');
Route::get('/tagedit/{i}', 'AdminController@fetchTag');
Route::post('/editforum', 'AdminController@editTag');
Route::post('/taghapus', 'AdminController@tagHapus');

Route::post('/catscam', 'AdminController@addKategoriScam');
Route::get('/scamedit/{i}', 'AdminController@fetchScam');
Route::post('/editscam', 'AdminController@editScam');
Route::post('/scamhapus', 'AdminController@hapusScam');

Route::get('/setting', 'SettingController@badword');
Route::post('/setting/badword', 'SettingController@updateBadword');