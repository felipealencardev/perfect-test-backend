<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Status;

class DashboardController extends Controller
{
    public function index() {
        $clients = Client::all();
        $sales = Sale::all();
        $products = Product::all();
        $resultSales = $this->getResultSales($sales);
        return view('dashboard', [
            'clients' => $clients,
            'sales' => $sales,
            'products' => $products,
            'resultSales' => $resultSales
        ]);
    }

    public function getResultSales() {
        $statusWithSales = Status::with('sales.product')->get()->all();

        $totalPriceReduceFunction = function ($totalPrice, $elem) {
            $price = $elem['product']['price'] * $elem['quantity'];
            if ($elem['discount'] > 0) {
                $price -= $price * ($elem['discount'] / 100);
            }
            $totalPrice += $price;
            return $totalPrice;
        };

        $resultSale = array_map(function($statusWithSales) use ($totalPriceReduceFunction) {
            $sales = $statusWithSales->sales;
            $salesQuantity = $sales->count();
            $price = array_reduce($sales->toArray(), $totalPriceReduceFunction, 0);
            $result = [
                'status' => $statusWithSales->label,
                'quantity' => $salesQuantity,
                'totalPrice' => 'R$' . number_format($price, 2, ',', '.')
            ];
            return $result;
        }, $statusWithSales);

        return $resultSale;
    }
}
