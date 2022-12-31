<?php

// Fill stats Routes

Route::redirect('/', '/fill_stats/formula', 301);
Route::redirect('/calculator', '/fill_stats/simulator', 301);

Route::get('/formula', 'FillController@index');
Route::get('/simulator', 'FillController@calculator');
Route::post('/save', 'FormulaController@store');
Route::get('/load', 'FormulaController@loadSaved');
Route::get('/get/{id}', 'FormulaController@getFormula');
Route::get('/show/{id}', 'FormulaController@showFormula');

Route::group(['middleware' => ['auth']], function () {
    Route::view('/myformula', 'fillstats.my-formula');
});

// admin, fill stats
Route::middleware('admin')->group(function () {
    Route::get('/add', 'FillController@add');
    Route::post('/add', 'FillController@addPost');
    Route::get('/edit/{id}/fillstats', 'FillController@edit')->middleware('auth');
    Route::post('/edit/{id}/fillstats', 'FillController@editPost');
    Route::delete('/delete/fillstats', 'FillController@destroy');
});

Route::get('/{type}', 'FillController@single');
Route::get('/{type}/{plus}', 'FillController@single');
