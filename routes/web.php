<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('sales', SaleController::class)->except(['index', 'show'])->names('sales');

Route::resource('products', ProductController::class)->except(['index', 'show'])->names('products');
