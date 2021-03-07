@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    @include('alert')
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='{{ route('sales.create') }}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form>
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select id="client_id" name="client_id" class="form-control">
                                <option value="null">Selecione um cliente</option>
                                @forelse ($clients as $client)
                                    <option
                                        value="{{ $client->id }}">
                                        {{ $client->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <thead>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        @php
                            $totalValue = $sale->product->price * $sale->quantity;
                            if ($sale->discount > 0) {
                                $totalValue -= $totalValue * ($sale->discount / 100);
                            }
                            $totalValue = 'R$' . number_format($totalValue, 2, ',', '.');
                        @endphp
                        <tr>
                            <td>
                                {{ $sale->product->name }}
                            </td>
                            <td>
                                {{ $sale->date }}
                            </td>
                            <td>
                                {{ $totalValue }}
                            </td>
                            <td>
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="4" style="text-align: center">Não há vendas</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>
                <tr>
                    <td>
                        Vendidos
                    </td>
                    <td>
                        100
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        R$ 100,00
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href='{{ route('products.create') }}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <thead>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        @php
                            $price = 'R$' . number_format($product->price, 2, ',', '.');
                        @endphp
                        <tr>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $price }}
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3" style="text-align: center">Não há produtos</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
