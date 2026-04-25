<?php

use App\Http\Controllers\FillController;
use App\Http\Controllers\FormulaController;
use Illuminate\Support\Facades\Route;

// Fill stats Routes

Route::redirect('/', '/fill_stats/formula', 301);
Route::redirect('/calculator', '/fill_stats/simulator', 301);

Route::get('/formula', [FillController::class, 'index']);
Route::get('/simulator', [FillController::class, 'calculator']);
Route::post('/save', [FormulaController::class, 'store']);
Route::get('/load', [FormulaController::class, 'loadSaved']);
Route::get('/get/{id}', [FormulaController::class, 'getFormula']);
Route::get('/show/{id}', [FormulaController::class, 'showFormula']);

Route::group(['middleware' => ['auth']], function () {
    Route::view('/myformula', 'fillstats.my-formula');
});

// admin, fill stats
Route::middleware('admin')->group(function () {
    Route::get('/add', [FillController::class, 'add']);
    Route::post('/add', [FillController::class, 'addPost']);
    Route::get('/edit/{id}/fillstats', [FillController::class, 'edit'])->middleware('auth');
    Route::post('/edit/{id}/fillstats', [FillController::class, 'editPost']);
    Route::delete('/delete/fillstats', [FillController::class, 'destroy']);
});

Route::get('/{type}', [FillController::class, 'single']);
Route::get('/{type}/{plus}', [FillController::class, 'single']);
