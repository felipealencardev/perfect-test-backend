<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $clients = Client::all();
        $sales = Sale::all();
        return view('dashboard', [
            'clients' => $clients,
            'sales' => $sales
        ]);
    }
}
