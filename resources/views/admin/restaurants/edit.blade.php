@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantEdit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">
        <div class="container mt-5 pt-5 text-white">
            <h1 class="pb-3">Aggiorna informazioni ristorante:</h1>

            <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nome ristorante --}}
                {{-- <div class="mb-3">
                <h2>{{ $restaurant->name }}</h2>
            </div> --}}
                {{-- Nome ristorante --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Ristorante</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nome ristorante qui..." aria-describedby="nameHelper" value="{{ $restaurant->name }}"
                        required min="3" max="255">

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Immagine --}}
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            @if ($restaurant->restaurant_image)
                                <img class="card-img-top w-50"
                                    src="{{ asset('storage/' . $restaurant->restaurant_image) }}"
                                    alt="{{ $restaurant->name }}" />
                            @else
                                <img src="{{ url('/img/placeholder/placeholder_restaurant.jpg') }}"
                                    alt="placeholder_restaurant" class="card-img-top w-50">
                            @endif



                        </div>
                        <div class="col">
                            <label for="restaurant_image" class="form-label">Modifica immagine</label>
                            <input type="file" name="restaurant_image" id="restaurant_image" aria-describedby="imageHelper"
                                accept="images/*" class="form-control @error('restaurant_image') is_invalid @enderror" />
                            <small id="restaurant_imageHelper">
                                Aggiungi la foto del tuo ristorante. [Max 500kb]
                            </small>
                        </div>
                    </div>
                    @error('restaurant_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Partita iva --}}
                <div class="mb-3">
                    <label for="vat" class="form-label">Partita IVA*</label>
                    <input type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" require
                        placeholder="Your restaurant vat here..." aria-describedby="vatHelper"
                        value="{{ $restaurant->vat }}" min="11" max="11">

                    @error('vat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Indirizzo --}}
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo*</label>
                    <input type="text" name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Your restaurant address here..." aria-describedby="addressHelper" required min="3"
                        max="255" value="{{ $restaurant->address }}">

                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sito web --}}
                <div class="mb-3">
                    <label for="website" class="form-label">Sito web</label>
                    <input type="text" name="website" id="website"
                        class="form-control @error('website') is-invalid @enderror"
                        placeholder="Inserisci il tuo sito web..." aria-describedby="websiteHelper"
                        value="{{ $restaurant->website }}">

                    @error('website')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Numero di telefono --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">Numero di telefono</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                        min="8" max="20" placeholder="Your restaurant phone here..." aria-describedby="phoneHelper"
                        value="{{ $restaurant->phone }}">

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
                            {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                            <option value="{{ $category->id }}"
                                {{ $restaurant->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                        @error('categories')
                            <div class="alert alert-dange">
                                {{ $message }}
                            </div>
                        @enderror
                    </select>
                </div>

                {{-- Descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" rows="5">{{ $restaurant->description }}</textarea>
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

                <button type="submit" class="btn mb-3 btn-dark">Salva</button>
            </form>
        </div>
    </div>
@endsection
