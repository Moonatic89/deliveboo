@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantCreate.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">

        <div class="container mt-5 pt-5 text-white">
            @include('partials.error')
            @include('partials.message')
            <h1>Creazione nuovo piatto</h1>
            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="restaurant_id" value={{ $restaurant_id }}>
                {{-- Nome prodotto --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Piatto*</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nome prodotto qui..." aria-describedby="nameHelper" value="{{ old('name') }}"
                        required min="3" max="255">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Immagine --}}
                <div class="mb-3">
                    <label for="product_image" class="form-label">Immagine</label>
                    <input type="file" name="product_image" id="product_image" accept="image/*" placeholder="https://"
                        aria-describedby="product_imageHelper"
                        class="form-control @error('product_image') is-invalid @enderror" />
                    @error('product_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Prezzo --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo*</label>
                    <input type="number" min="0.00" max="10000.00" step="0.01" name="price" id="price" required
                        class="form-control @error('price') is-invalid @enderror" aria-describedby="priceHelper"
                        value="{{ old('price') }}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Ingredienti --}}
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti</label>
                    <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients"
                        id="ingredients" rows="5">{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Visibile --}}
                <div class="mb-3">
                    <label for="visible" class="form-label">Mostra il piatto nel menu</label>
                    <select name="visible" id="visible">
                        <option selected value="1">
                            Si
                        </option>
                        <option value="0">
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
                <button type="submit" class="btn btn-dark">Salva</button>
            </form>
        </div>

    </div>
@endsection
