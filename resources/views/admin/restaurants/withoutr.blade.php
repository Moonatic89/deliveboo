@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantCreate.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">
        <div class="container mt-2 pt-2">
            <h1 class="pb-3 ">Creazione del ristorante</h1>

            <form action="{{ route('admin.register.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Nome ristorante --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Ristorante*</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Il nome del tuo ristorante ..." aria-describedby="nameHelper"
                        value="{{ old('name') }}" required minlength="3" maxlength="255">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Immagine --}}
                <div class="mb-3">
                    <label for="restaurant_image" class="form-label">Immagine</label>
                    <input type="file" name="restaurant_image" id="restaurant_image" accept="image/*" placeholder="https://"
                        aria-describedby="restaurant_imageHelper"
                        class="form-control @error('restaurant_image') is-invalid @enderror" />
                    @error('restaurant_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Partita iva --}}
                <div class="mb-3">
                    <label for="vat" class="form-label">Partita IVA*</label>
                    <input type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" required
                        placeholder="Partita IVA ristorante ..." aria-describedby="vatHelper" value="{{ old('vat') }}"
                        minlength="11" maxlength="11">

                    @error('vat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Indirizzo --}}
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo*</label>
                    <input type="text" name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Indirizzo del ristorante..." aria-describedby="addressHelper"
                        value="{{ old('address') }}" required minlength="3" maxlength="255">

                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sito web --}}
                <div class="mb-3">
                    <label for="website" class="form-label">Sito web</label>
                    <input type="text" name="website" id="website"
                        class="form-control @error('website') is-invalid @enderror" placeholder="Sito web del ristorante..."
                        aria-describedby="websiteHelper" value="{{ old('website') }}">

                    @error('website')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Telefono --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">Numero di telefono</label>
                    <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                        minlength="8" maxlength="20" placeholder="Telefono del ristorante ..."
                        aria-describedby="phoneHelper" value="{{ old('phone') }}">

                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Categorie --}}
                <div class="mb-3">
                    <label for="categories" class="form-label">Seleziona categoria*</label>
                    <select class="form-control @error('categories') is_invalid @enderror" name="categories[]"
                        id="categories" required multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        placeholder="Inserisci la descrizione del ristorante" id="description"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campi Obbligatori --}}
                <div class="form-group row mb-2">
                    <div class="col-md-4 col-form-label text-md-right">
                        * {{ __('Campi Obbligatori') }}
                    </div>
                </div>

                <button type="submit" class="btn btn-dark mb-4">Salva</button>
            </form>
        </div>
    </div>
@endsection
