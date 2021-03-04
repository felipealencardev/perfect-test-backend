<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/sales', function () {
    return view('crud_sales');
});

Route::resource('products', ProductController::class)->except(['index', 'show'])->names('products');
