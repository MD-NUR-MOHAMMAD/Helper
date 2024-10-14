<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckClientRole;
use App\Http\Middleware\CheckEmployeeRole;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('welcome');
// });

Route ::get('/', [HomeController::class, 'index'])->name('index');
Route ::get('employee', [HomeController::class, 'employee'])->name('home');

//HomeController
Route ::get('user', [UserController::class, 'index'])->name('home');
Route ::get('user/create', [UserController::class, 'create'])->name('home');
Route ::get('user/edit', [UserController::class, 'edit'])->name('home');
Route ::get('user/update', [UserController::class, 'update'])->name('home');

//EmployeeController
// Route ::get('employee', [EmployeeController::class, 'index']);
// Route ::get('employee/create', [EmployeeController::class, 'create'])->name('home');
// Route ::get('employee/edit', [EmployeeController::class, 'edit'])->name('home');

//ParcelController
Route ::get('parcel', [ParcelController::class, 'index']);
Route ::get('parcel/create', [ParcelController::class, 'create']);
Route ::get('parcel/edit', [ParcelController::class, 'edit']);

//PaymentController
Route ::get('payment', [PaymentController::class, 'index']);
Route ::get('payment/create', [PaymentController::class, 'create']);
Route ::get('payment/edit', [PaymentController::class, 'edit']);


//dashboard links
// Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
// Route::get('/employee', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('employee');
// Route::get('/client', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('client');



Route::get('/bijoy', function () {
    return view('admin.bijoy');
})->middleware(['auth', 'verified'])->name('bijoy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(CheckAdminRole::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'adminIndex'])->name('admin');
});
Route::middleware(CheckEmployeeRole::class)->group(function () {
    Route::get('/employee', [AdminController::class, 'employeeIndex'])->name('employee');
});
Route::middleware(CheckClientRole::class)->group(function () {
    Route::get('/client', [AdminController::class, 'clientIndex'])->name('client');
});



require __DIR__.'/auth.php';
