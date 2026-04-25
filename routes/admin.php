<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::get('/', [AdminController::class, 'home']);
Route::get('/users', [AdminController::class, 'users']);
Route::get('/last-login', [AdminController::class, 'lastLogin']);
Route::get('/searches', [AdminController::class, 'logSearches']);
Route::get('/last_forum_posts', [AdminController::class, 'lastThread']);

Route::put('/change-user', [AdminController::class, 'changeUser']);
Route::post('/tagforum', [AdminController::class, 'tagForum']);
Route::get('/tagedit/{i}', [AdminController::class, 'fetchTag']);
Route::post('/editforum', [AdminController::class, 'editTag']);
Route::post('/taghapus', [AdminController::class, 'tagHapus']);

Route::post('/catscam', [AdminController::class, 'addKategoriScam']);
Route::get('/scamedit/{i}', [AdminController::class, 'fetchScam']);
Route::post('/editscam', [AdminController::class, 'editScam']);
Route::post('/scamhapus', [AdminController::class, 'hapusScam']);

Route::get('/setting', [SettingController::class, 'badword']);
Route::post('/setting/badword', [SettingController::class, 'updateBadword']);

// skill
Route::get('/skill', [SkillController::class, 'showEdit']);
Route::post('/skill/store', [SkillController::class, 'store']);
Route::get('/skill/store/child', [SkillController::class, 'storeChild']);
Route::post('/skill/store/child', [SkillController::class, 'storeChildPost']);
Route::post('/skill/save', [SkillController::class, 'skillSave']);
Route::get('/skill/child', [SkillController::class, 'showChild']);
Route::delete('/skill/child/delete', [SkillController::class, 'deleteChild']);

//forum
Route::get('/forum/kategori', [ForumController::class, 'editKategori']);
Route::post('/forum/kategori', [ForumController::class, 'storeKategori']);
Route::post('/forum/kategori/save', [ForumController::class, 'postEditKategori']);

// registled

Route::view('/registled', 'registled.admin.edit');
