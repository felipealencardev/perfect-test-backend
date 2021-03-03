@extends('layout')

@section('content')
    <h1>Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" action="/products/{{ $product->id }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                    >
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea
                        type="text"
                        rows='5'
                        class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        name="description"
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input
                        type="text"
                        class="form-control @error('price') is-invalid @enderror"
                        id="price"
                        placeholder="100,00 ou maior"
                        name="price"
                        value="{{ old('price', $product->price) }}">
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
