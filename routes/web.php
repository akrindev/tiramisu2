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