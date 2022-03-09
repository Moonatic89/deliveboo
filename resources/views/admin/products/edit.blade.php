@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantCreate.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">

        <div class="container mt-5 pt-5 text-white">
            <h1>Aggiorna Prodotto</h1>

            <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nome prodotto --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Piatto*</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nome prodotto qui..." aria-describedby="nameHelper" value="{{ $product->name }}"
                        required min="3" max="255">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Immagine --}}
                <div class="mb-3">
                    <div class="row">

                        <div class="col-4">

                            @if ($product->product_image === null)
                                <img src="{{ url('/img/placeholder/placeholder_product.jpg') }}" alt="placeholder_product"
                                    class="card-img-top w-50">
                            @else
                                <img class="w-50" src="{{ asset('storage/' . $product->product_image) }}"
                                    alt="{{ $product->name }}" />>
                            @endif

                        </div>
                        <div class="col">
                            <label for="product_image" class="form-label">Modifica immagine</label>
                            <input type="file" name="product_image" id="product_image" aria-describedby="imageHelper"
                                accept="images/*" class="form-control @error('product_image') is_invalid @enderror" />
                            <small id="product_imageHelper">
                                Aggiungi una immagine al prodotto. [Max 500kb]
                            </small>
                        </div>
                    </div>
                    @error('product_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prezzo --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo*</label>
                    <input type="number" min="0.00" max="10000.00" step="0.01" name="price" id="price" required
                        class="form-control @error('price') is-invalid @enderror" aria-describedby="priceHelper"
                        value="{{ $product->price }}">

                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ingredienti --}}
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti</label>
                    <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients"
                        id="ingredients" rows="5">{{ $product->ingredients }}</textarea>
                    @error('ingredients')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Visibile --}}
                <div class="mb-3">
                    <label for="visible" class="form-label">Mostra il piatto nel menu</label>
                    <select name="visible" id="visible">
                        <option {{ $product->visible == old('visible', 1) ? 'selected=selected' : '' }} value="1">
                            Si
                        </option>
                        <option {{ $product->visible == old('visible', 0) ? 'selected=selected' : '' }} value="0">
                            No
                        </option>
                    </select>
                    @error('visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campi Obbligatori --}}
                <div class="form-group row mb-2">
                    <div class="col-md-4 col-form-label text-md-right">
                        * {{ __('Campi Obbligatori') }}
                    </div>
                </div>

                <button type="submit" class="btn btn-dark mb-3">Salva</button>
            </form>
        </div>

    </div>
@endsection
