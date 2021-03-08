<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::resource('/', DashboardController::class)->only(['index'])->names('dashboard');
Route::get('search', [DashboardController::class, 'search'])->name('dashboard.search');

Route::resource('sales', SaleController::class)->except(['index', 'show'])->names('sales');

Route::resource('products', ProductController::class)->except(['index', 'show'])->names('products');
