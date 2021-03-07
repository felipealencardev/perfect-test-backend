<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index() {
        $clients = Client::all();
        $sales = Sale::all();
        $products = Product::all();
        return view('dashboard', [
            'clients' => $clients,
            'sales' => $sales,
            'products' => $products
        ]);
    }
}
