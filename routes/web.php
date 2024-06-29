<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/aktual', [ActualController::class, 'index'])->name('actual.index');
    Route::get('/aktual/create', [ActualController::class, 'create'])->name('actual.create');
    Route::get('/aktual/{id}/edit', [ActualController::class, 'edit'])->name('actual.edit');
    Route::post('/aktual', [ActualController::class, 'store'])->name('actual.store');
    Route::put('/aktual/{id}', [ActualController::class, 'update'])->name('actual.update');
    Route::delete('/aktual/{id}', [ActualController::class, 'destroy'])->name('actual.delete');

    Route::get('/perhitungan', [CalculateController::class, 'index'])->name('calculate.index');
    Route::post('/perhitungan', [CalculateController::class, 'result'])->name('calculate.result');
});
