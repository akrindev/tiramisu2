<?php

use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
| ------
| --- English Routes
| ------
*/

Route::view('/', 'toram');
Route::get('/search', [SearchController::class, 'search']);

/**
 * Appearance
 */
Route::prefix('appearance')->group(function () {
    Route::get('/', [AppearanceController::class, 'show']);
    Route::get('/{type}', [AppearanceController::class, 'type']);
});

// items english

Route::get('/items', [ItemController::class, 'showAllItems']);
Route::get('/items/{id}', [ItemController::class, 'showItems']);

Route::get('/item', [ItemController::class, 'showThem']);
Route::get('/item/{id}', [ItemController::class, 'showItem']);

// monster in english

// Monster routes
Route::prefix('monster')->group(function () {
    Route::get('/', [MonsterController::class, 'index']);
    Route::get('/{id}', [MonsterController::class, 'showMons']);
    Route::get('/type/{name}', [MonsterController::class, 'showMonsType']);
    Route::get('/unsur/{type}', [MonsterController::class, 'showMonsEl']);
});

// map

Route::get('/peta', [MonsterController::class, 'index']);
Route::get('/peta/{id}', [MonsterController::class, 'peta']);

Route::get('/latest_search', [SitemapController::class, 'show']);
