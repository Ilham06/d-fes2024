<?php

use App\Http\Controllers\ActualController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/aktual', [ActualController::class, 'index'])->name('actual.index');
    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/hasil-peramalan', [CalculateController::class, 'savedResult'])->name('calculate.savedResult');

    Route::get('/help', [App\Http\Controllers\HomeController::class, 'help'])->name('help');
    Route::get('/print-pdf', [CalculateController::class, 'printPDF'])->name('calculate.printPDF');
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

    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});
