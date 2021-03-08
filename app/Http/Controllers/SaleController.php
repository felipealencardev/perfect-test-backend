<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalePostRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Status;
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
        $status = Status::all();
        return view('sale/crud_sales', [
            'products' => $products,
            'status' => $status
        ]);
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
                'status_id' => $data['status_id'],
                'date' => $data['date'],
                'quantity' => $data['quantity'],
                'discount' => $data['discount'],
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
        $status = Status::all();
        return view('sale/crud_sales', [
            'sale' => $sale,
            'products' => $products,
            'status' => $status
        ]);
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
                'status_id' => $data['status_id'],
                'date' => $data['date'],
                'quantity' => $data['quantity'],
                'discount' => $data['discount'],
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

}
