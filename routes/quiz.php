<?php

// quiz routes
Route::get('/', 'QuizController@show');
Route::get('/score', 'QuizController@allScores');
Route::get('/buat', 'QuizController@tambah');
Route::post('/cek-kode', 'QuizController@cekKode');
Route::get('/kode/{code}', 'QuizController@lihatKode');

// must be login
Route::middleware('auth')->group(function () {
    Route::get('/mulai', 'QuizController@mulaiQuiz');
    Route::get('/begin', 'QuizController@kerjakan');

    Route::get('/kode/{code}/mulai', 'QuizController@ambilQuiz');
    Route::get('/code/begin', 'QuizController@kerjakanByCode');
    Route::get('/code/koreksi', 'QuizController@koreksiByCode');

    Route::get('/i/{id}', 'QuizController@ajax');
    Route::post('/save', 'QuizController@saveAnswer');
    Route::get('/ajax/terjawab', 'QuizController@ajaxTerjawab');
    Route::get('/koreksi', 'QuizController@koreksi');
    Route::get('/profile', 'QuizController@myProfile');
    Route::post('/buat', 'QuizController@tambahSubmit');

    Route::get('/buat-kode', 'QuizController@buatKode');
    Route::post('/buat-kode', 'QuizController@buatKodePost');
});

// admin
Route::middleware('admin')->group(function () {
    Route::get('/edit/{id}', 'QuizController@edit');
    Route::post('/edit/{id}', 'QuizController@editSubmit');
    Route::post('/destroy', 'QuizController@destroy');
    Route::get('/admin', 'QuizController@admin');
});
