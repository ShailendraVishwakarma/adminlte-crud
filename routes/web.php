<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLogController;
use App\Http\Controllers\CsvController;
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);

/* Logout */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* Protected routes */
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('product-logs', [ProductLogController::class, 'index'])->name('product.logs');
    Route::get('/csv-upload', function () {
    return view('upload-csv');
});

    Route::post('/csv-upload', [CsvController::class, 'upload'])->name('csv.upload');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});