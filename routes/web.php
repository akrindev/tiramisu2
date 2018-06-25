<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('toram');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/exp', 'XpController@index');

Route::get('/fb-login', 'Auth\LoginController@redirect');
Route::get('/facebook/callback', 'Auth\LoginController@callback');

Route::get('/profile', 'UserController@profile');

Route::get('/profile/{provider_id}', 'UserController@profile');


Route::get('/equips/{slug}', 'EquipController@equips');
Route::get('/equip/{slug}', 'EquipController@equip');
Route::get('/edit/{id}/equip', 'EquipController@edit');
Route::post('/edit/{id}/equip', 'EquipController@editPost');
Route::delete('/edit/equip/delete', 'EquipController@destroy');

Route::get('/store-equip', 'EquipController@tambah');

Route::post('/store-equip', 'EquipController@tambahPost');



Route::get('/crystas/{slug}', 'CrystaController@crystas');
Route::get('/crysta/{slug}', 'CrystaController@crysta');

Route::get('/edit/{id}/crysta', 'CrystaController@edit');
Route::post('/edit/{id}/crysta', 'CrystaController@editPost');
Route::delete('/edit/crysta/delete', 'CrystaController@destroy');

Route::get('/store-crysta', 'CrystaController@tambah');

Route::post('/store-crysta', 'CrystaController@tambahPost');

Route::get('/fill_stats', 'FillController@index');
Route::get('/fill_stats/add', 'FillController@add');
Route::post('/fill_stats/add', 'FillController@addPost');
Route::get('/fill_stats/{type}', 'FillController@single');
Route::get('/fill_stats/{type}/{plus}', 'FillController@single');
Route::get('/edit/{id}/fillstats', 'FillController@edit');
Route::post('/edit/{id}/fillstats', 'FillController@editPost');
Route::delete('/delete/fillstats', 'FillController@destroy');

/**
* Monster routes
*/
Route::get('/monster', 'MobController@index');
Route::get('/monster/{slug}', 'MobController@single');
Route::get('/peta/{slug}', 'MobController@peta');

Route::get('/store-mob', 'MobController@add');
Route::post('/store-mob', 'MobController@addPost');
Route::get('/edit/{id}/mobs', 'MobController@edit');
Route::post('/edit/{id}/mobs', 'MobController@editPost');
Route::delete('/edit/mob/delete', 'MobController@destroy');