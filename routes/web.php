<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;

Route::get('/', [ResidentController::class, 'index'])->name('residents.index');
Route::post('/residents', [ResidentController::class, 'store'])->name('resident.post');
Route::get('/ajax-client', [ResidentController::class, 'ajax'])->name('residents.ajax');
Route::get('/http-client', [ResidentController::class, 'http'])->name('residents.http');
