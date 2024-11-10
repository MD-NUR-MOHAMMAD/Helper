<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminCheck;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('admin')->group(function () {
    Route::get('/crud', [CrudController::class, 'index'])->name('crud.index');
    Route::post('/crud/add', [CrudController::class, 'store'])->name('crud.store');
    Route::get('/crud/add', [CrudController::class, 'create'])->name('crud.create');
    Route::get('/crud/edit', [CrudController::class, 'edit'])->name('crud.edit');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
