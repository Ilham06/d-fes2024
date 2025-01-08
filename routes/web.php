<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/aktual', [ActualController::class, 'index'])->name('actual.index');
    Route::get('/hasil-peramalan', [CalculateController::class, 'savedResult'])->name('calculate.savedResult');

    Route::get('/help', [App\Http\Controllers\HomeController::class, 'help'])->name('help');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/aktual/create', [ActualController::class, 'create'])->name('actual.create');
    Route::get('/aktual/{id}/edit', [ActualController::class, 'edit'])->name('actual.edit');
    Route::post('/aktual', [ActualController::class, 'store'])->name('actual.store');
    Route::put('/aktual/{id}', [ActualController::class, 'update'])->name('actual.update');
    Route::delete('/aktual/{id}', [ActualController::class, 'destroy'])->name('actual.delete');
    Route::post('/aktual/import', [ActualController::class, 'import'])->name('actual.import');
    Route::get('/aktual/export', [ActualController::class, 'export'])->name('actual.export');
    Route::get('/perhitungan', [CalculateController::class, 'index'])->name('calculate.index');
    Route::post('/perhitungan', [CalculateController::class, 'result'])->name('calculate.result');
    Route::post('/hasil-peramalan', [CalculateController::class, 'saved'])->name('calculate.saved');
    Route::resource('user', UserController::class);
    Route::post('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
});
