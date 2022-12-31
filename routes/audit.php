<?php

use App\Http\Livewire\Audit\Index as AuditIndex;
use Illuminate\Support\Facades\Route;

Route::get('admin/audit', AuditIndex::class)->name('audit');
