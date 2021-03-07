<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/crud_products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPostRequest $request)
    {
        try {
            $data = $request->all();
            Product::create($data);
            return redirect()->route('dashboard.index')->with('success', 'Produto salvo com sucesso');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Falha ao salvar produto');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product/crud_products', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductPostRequest $request, Product $product)
    {
        try {
            $data = $request->all();
            $product->fill($data)->save();
            return redirect()->route('dashboard.index')->with('success', 'Produto salvo com sucesso');
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
