<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

// quiz routes
Route::get('/', [QuizController::class, 'show']);
Route::get('/score', [QuizController::class, 'allScores']);
Route::get('/buat', [QuizController::class, 'tambah']);
Route::post('/cek-kode', [QuizController::class, 'cekKode']);
Route::get('/kode/{code}', [QuizController::class, 'lihatKode']);

// must be login
Route::middleware('auth')->group(function () {
    Route::get('/mulai', [QuizController::class, 'mulaiQuiz']);
    Route::get('/begin', [QuizController::class, 'kerjakan']);

    Route::get('/kode/{code}/mulai', [QuizController::class, 'ambilQuiz']);
    Route::get('/code/begin', [QuizController::class, 'kerjakanByCode']);
    Route::get('/code/koreksi', [QuizController::class, 'koreksiByCode']);

    Route::get('/i/{id}', [QuizController::class, 'ajax']);
    Route::post('/save', [QuizController::class, 'saveAnswer']);
    Route::get('/ajax/terjawab', [QuizController::class, 'ajaxTerjawab']);
    Route::get('/koreksi', [QuizController::class, 'koreksi']);
    Route::get('/profile', [QuizController::class, 'myProfile']);
    Route::post('/buat', [QuizController::class, 'tambahSubmit']);

    Route::get('/buat-kode', [QuizController::class, 'buatKode']);
    Route::post('/buat-kode', [QuizController::class, 'buatKodePost']);
});

// admin
Route::middleware('admin')->group(function () {
    Route::get('/edit/{id}', [QuizController::class, 'edit']);
    Route::post('/edit/{id}', [QuizController::class, 'editSubmit']);
    Route::post('/destroy', [QuizController::class, 'destroy']);
    Route::get('/admin', [QuizController::class, 'admin']);
});
