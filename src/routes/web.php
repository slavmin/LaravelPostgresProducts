<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\ProductController::class, 'available'])->name('welcome');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\ProductController::class, 'index'])->name('dashboard');
    Route::get('/trashbin', [\App\Http\Controllers\ProductController::class, 'trashbin'])->name('trashbin');

    Route::resource('product', \App\Http\Controllers\ProductController::class, ['except' => ['show']]);
    Route::group(['prefix' => '/product/{id}'], function () {
        Route::get('restore', [\App\Http\Controllers\ProductController::class, 'restore'])->name('product.restore');
        Route::delete('delete', [\App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete-permanently');
    });
});

require __DIR__ . '/auth.php';
