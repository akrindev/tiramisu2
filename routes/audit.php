<?php

use App\Livewire\Audit\Index as AuditIndex;
use Illuminate\Support\Facades\Route;

Route::get('admin/audit', AuditIndex::class)->middleware(['admin'])->name('audit');
