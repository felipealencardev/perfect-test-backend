<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleSearchRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Status;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $clients = Client::all();
        $sales = Sale::all();
        $products = Product::all();
        $resultSales = $this->getResultSales();
        return view('dashboard', [
            'clients' => $clients,
            'sales' => $sales,
            'products' => $products,
            'resultSales' => $resultSales
        ]);
    }

    public function search(SaleSearchRequest $request) {
        $dataSearch = $request->all();
        $clientId = $dataSearch['client_id'];
        $dates = explode(' - ', $dataSearch['dates']);
        $firstDate = Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d');
        $lastDate = Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d');

        $salesFiltered = Sale::where(function($query) use ($clientId) {
                if (!is_null($clientId) && $clientId !== 'null') {
                    $query->where('client_id', $clientId);
                }
            })
            ->where('date', '>=', $firstDate)
            ->where('date', '<=', $lastDate)
            ->get();

        $clients = Client::all();
        $products = Product::all();
        $resultSales = $this->getResultSales();
        return view('dashboard', [
            'clients' => $clients,
            'client_id' => $clientId,
            'dates' => $dates,
            'sales' => $salesFiltered,
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
