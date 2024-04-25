<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ResidentController::class, 'index'])->name('residents.index');
Route::post('/residents', [ResidentController::class, 'store'])->name('resident.post');
Route::get('/residents', [ResidentController::class, 'retrieve'])->name('resident.get-all');
