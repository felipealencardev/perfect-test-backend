<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalePostRequest;
use App\Http\Requests\SaleSearchRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Throwable;

class SaleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('sale/crud_sales', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalePostRequest $request)
    {
        try {
            $data = $request->all();
            $dataClient = [
                'name' => $data['name'],
                'email' => $data['email'],
                'cpf' => $data['cpf'],
            ];
            $client = Client::Create($dataClient);

            $dataSale = [
                'product_id' => $data['product_id'],
                'client_id' => $client->id,
                'date' => $data['date'],
                'quantity' => $data['quantity'],
                'discount' => $data['discount'],
                'status' => $data['status']
            ];
            Sale::create($dataSale);
            return redirect()->route('dashboard.index')->with('success', 'Venda salva com sucesso');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Falha ao salvar venda');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::with('client')->find($id);
        $products = Product::all();
        return view('sale/crud_sales', ['sale' => $sale, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalePostRequest $request, Sale $sale)
    {
        try {
            $data = $request->all();
            $dataClient = [
                'name' => $data['name'],
                'email' => $data['email'],
                'cpf' => $data['cpf'],
            ];
            $client = Client::findOrFail($sale->client_id);
            $client->fill($dataClient)->save();

            $dataSale = [
                'product_id' => $data['product_id'],
                'client_id' => $client->id,
                'date' => $data['date'],
                'quantity' => $data['quantity'],
                'discount' => $data['discount'],
                'status' => $data['status']
            ];
            $sale->fill($dataSale)->save();
            return redirect()->route('dashboard.index')->with('success', 'Venda salva com sucesso');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Falha ao salvar produto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        return view('dashboard', [
            'clients' => $clients,
            'client_id' => $clientId,
            'dates' => $dates,
            'sales' => $salesFiltered,
            'products' => $products
        ]);
    }
}
