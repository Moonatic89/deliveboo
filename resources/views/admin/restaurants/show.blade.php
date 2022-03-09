@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantShow.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="scroll">
        <div class="container">


            {{-- Restaurant Card --}}
            <div class="pt-2 row row-cols-1 row-cols-lg-2">
                <div class="col">


                    <div class="card mt-5 w-100 cardR justify-content-center border-0">

                        @if ($restaurant->restaurant_image === null)
                            <img src="{{ url('/img/placeholder/placeholder_restaurant.jpg') }}"
                                alt="placeholder_restaurant" class="card-img-top">
                        @else
                            <img src=" {{ asset('storage/' . $restaurant->restaurant_image) }}" class="card-img-top"
                                alt="{{ $restaurant->name }}">
                        @endif
                        <div class="card-body text-dark">
                            <h5 class="card-title">
                                {{ $restaurant->name }}
                            </h5>
                            <p class="card-text">{{ $restaurant->description }}</p>

                            {{-- Contacts --}}
                            <div class="contacts">

                                @if ($restaurant->website)
                                    <a href="{{ $restaurant->website }}" target="_blank"
                                        class="btn btn-sm btn-primary">{{ $restaurant->website }}</a>
                                @else
                                    <span>Nessun sito web</span>
                                @endif

                                <div class="mt-2">
                                    Tel: {{ $restaurant->phone }}
                                </div>

                                {{-- Category badges --}}
                                <div class="badges mt-2">
                                    <p>
                                        @forelse($restaurant->categories as $category)
                                            <span class="badge bg-warning text-dark rounded-0">
                                                {{ $category->name }}
                                            </span>
                                        @empty
                                            <span>Nessuna Categoria</span>
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ordini-stats mt-3 d-flex align-items-center">
                        {{-- Mostra ordini --}}
                        <a class="btn btn-warning rounded-0 me-3"
                            href="{{ route('admin.order.index', $restaurant->id) }}" role="button">Ordini Ristorante</a>

                        <a class="btn btn-warning rounded-0" href="{{ route('admin.order.chart', $restaurant->id) }}"
                            role="button">Statistiche</a>
                    </div>
                </div>


                <div class="col mt-3">
                    {{-- Menu and create new product --}}
                    <div class="d-flex align-items-center mb-4 mt-4 justify-content-between text-warning">
                        <h4 class="me-3">Menu</h4>
                        <a class="btn btn-success  rounded-pill"
                            href="{{ route('admin.product.create', ['restaurant' => $restaurant->id]) }}" role="button">
                            Aggiungi un piatto
                        </a>
                    </div>
                    {{-- NEW card products --}}
                    @foreach ($restaurant->products as $product)
                        <div class=" card respCard mb-5">

                            <div
                                class="{{ $product->visible === 0 ? 'text-secondary' : '' }} row justify-content-center row-cols-1 row-cols-md-3">

                                <div class="col">
                                    <div class="image centered d-flex justify-content-center align-items-center h-100">
                                        @if ($product->product_image === null)
                                            <img src="{{ url('/img/placeholder/placeholder_product.jpg') }}"
                                                style="object-fit:cover" height="150" alt="product placeholder">
                                        @else
                                            <img class="w-100 p-1" style="object-fit:cover" height=" 150"
                                                src="{{ asset('storage/' . $product->product_image) }}"
                                                alt="{{ $product->name }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="infoR">


                                        <h5 class="card-title ">Nome del prodotto: {{ $product->name }}</h5>
                                        <p class="card-text ">Pezzo: €{{ $product->price }}</p>
                                        <p class="card-text ">{{ $product->ingredients }}</p>
                                        <p class="card-text ">Visibilità:
                                            {{ $product->visible === 1 ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="btns d-flex flex-column justify-content-around pe-4 h-100">

                                        <a class="btn btn-warning"
                                            href="{{ route('admin.products.edit', $product->id) }}">
                                            Modifica
                                        </a>

                                        {{-- Button trigger modal --}}
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                            data-bs-target="#delete_product_{{ $product->id }}">
                                            Elimina
                                        </button>

                                        {{-- Modal --}}
                                        <div class="modal fade" id="delete_product_{{ $product->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal_{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Elimina prodotto:
                                                            {{ $product->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sei sicuro di procedere?<br>
                                                        Stai eliminando il prodotto per sempre!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">CHIUDI</button>
                                                        <form
                                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger text-white"
                                                                data-bs-dismiss="modal">ELIMINA</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <a class="btn btn-secondary mb-5" href="{{ route('admin.restaurants.index') }}" role="button">
                Torna indietro
            </a> --}}
        </div>
    </div>
@endsection
