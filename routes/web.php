<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MataKuliahController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/',        [UserController::class, 'index'])->name('index');
    Route::get('/create',  [UserController::class, 'create'])->name('create');
    Route::post('/',       [UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}',      [UserController::class, 'update'])->name('update');
    Route::delete('/{id}',   [UserController::class, 'destroy'])->name('destroy');
});
Route::prefix('mata-kuliah')->name('matakuliah.')->group(function () {
    Route::get('/',          [MataKuliahController::class, 'index'])->name('index');
    Route::get('/create',    [MataKuliahController::class, 'create'])->name('create');
    Route::post('/',         [MataKuliahController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [MataKuliahController::class, 'edit'])->name('edit');
    Route::put('/{id}',      [MataKuliahController::class, 'update'])->name('update');
    Route::delete('/{id}',   [MataKuliahController::class, 'destroy'])->name('destroy');
});

Route::redirect('/matakuliah', '/mata-kuliah');
Route::redirect('/matakuliah/create', '/mata-kuliah/create');
