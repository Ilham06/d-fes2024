<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/aktual', [ActualController::class, 'index'])->name('actual.index');
    Route::get('/aktual/create', [ActualController::class, 'create'])->name('actual.create');
    Route::get('/aktual/{id}/edit', [ActualController::class, 'edit'])->name('actual.edit');

    Route::get('/perhitungan', [CalculateController::class, 'index'])->name('calculate.index');
    Route::post('/perhitungan', [CalculateController::class, 'result'])->name('calculate.result');
});
