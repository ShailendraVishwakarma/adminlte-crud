<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLogController;
use App\Http\Controllers\CsvController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerPost']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ✅ EXPORT ROUTE (RESOURCE SE UPAR)
    Route::get('/products/export', [ProductController::class, 'export'])
        ->name('products.export');

    // Products CRUD
    Route::resource('products', ProductController::class);

    // Product Logs
    Route::get('/product-logs', [ProductLogController::class, 'index'])
        ->name('product.logs');

    // CSV Upload
    Route::get('/csv-upload', function () {
        return view('upload-csv');
    });

    Route::post('/csv-upload', [CsvController::class, 'upload'])
        ->name('csv.upload');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');
});
