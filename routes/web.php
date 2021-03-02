<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/sales', function () {
    return view('crud_sales');
});

Route::get('/products', function () {
    return view('crud_products');
});
