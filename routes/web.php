<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::view('/kriteria', 'kriteria')->name('kriteria');
Route::view('/subkriteria', 'subkriteria')->name('subkriteria');
Route::view('/dataset', 'dataset')->name('dataset');
Route::view('/hasil', 'hasil')->name('hasil');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');