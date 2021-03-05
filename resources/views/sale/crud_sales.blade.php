@extends('layout')

@section('content')
    <h1>{{ isset($sale) ? 'Editar' : 'Adicionar' }} Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" action="{{ isset($sale) ? route('sales.update', $sale->id) : route('sales.store') }}">
                @if (isset($sale))
                    @method('PUT')
                @endif
                @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name', $sale->client->name ?? '') }}"
                    >
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email', $sale->client->email ?? '') }}"
                    >
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input
                        type="text"
                        class="form-control @error('cpf') is-invalid @enderror"
                        id="cpf"
                        name="cpf"
                        placeholder="99999999999"
                        maxlength="11"
                        value="{{ old('cpf', $sale->client->cpf ?? '') }}"
                    >
                    @error('cpf')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product_id">Produto</label>
                    <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value="null">Selecione um Produto</option>
                        @forelse ($products as $product)
                            <option
                                value="{{ $product->id }}"
                                {{((old("product_id", $sale->product_id ?? '') == $product->id) ? 'selected' : '') }}>
                                {{ $product->name }}
                            </option>
                        @empty

                        @endforelse
                    </select>
                    @error('product_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input
                        type="text"
                        class="form-control single_date_picker @error('date') is-invalid @enderror"
                        id="date"
                        name="date"
                        value="{{ old('date', $sale->data ?? '') }}"
                    >
                    @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input
                        type="text"
                        class="form-control @error('quantity') is-invalid @enderror"
                        id="quantity"
                        name="quantity"
                        placeholder="1 a 10"
                        value="{{ old('quantity', $sale->quantity ?? '') }}"
                    >
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input
                        type="text"
                        class="form-control @error('discount') is-invalid @enderror"
                        id="discount"
                        name="discount"
                        placeholder="100,00 ou menor"
                        value="{{ old('discount', $sale->discount ?? '') }}"
                    >
                    @error('discount')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="status_id">Status</label>
                    <select id="status_id" name="status_id" class="form-control @error('status_id') is-invalid @enderror">
                        <option value="null">Selecione um Status</option>
                        @forelse ($status as $st)
                            <option
                                value="{{ $st->id }}"
                                {{((old("status_id", $sale->status_id ?? '') == $st->id) ? 'selected' : '') }}>
                                {{ $st->label }}
                            </option>
                        @empty

                        @endforelse
                    </select>
                    @error('status_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                        <option
                            value=""
                            disabled
                            hidden
                            {{ old('status') === null ? 'selected' : '' }}>Selecione um Status</option>
                        <option value="aprovado">Aprovado</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="devolvido">Devolvido</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
