@extends('layouts.app')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ristoranteGuestShow.css') }}">
@endsection


@section('content')
    {{-- jumbo pizza --}}
    <div id="custom-data" data-profiles="{{ $restaurant->id }}" class="contenitore-jumbo">
        {{-- <div class="right-sidebar">
            <cart-component @refresh-qty="refreshQty" :total="total" :cart="cart"></cart-component>
        </div> --}}
        <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}" alt="{{ $restaurant->name }}"
            class="pizza mt-5">

        <div class="contenitore-titolo text-white">
            <h1 class="restaurant-name">{{ $restaurant->name }}</h1>
            <p>{{ $restaurant->description }}</p>
            <a href="#order_now" role="button" class="btn btn-warning mb-2">Order Now</a>
        </div>
    </div>

    <div class="top-pics mt-5 pt-5" id="order_now">
        <div class="line"></div>
        <div class="text">Choose your meal</div>
        <div class="line"></div>
    </div>

    <div class="container mt-4 testo">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus laboriosam esse provident sed ipsam
            voluptas.</p>
    </div>

    <div class="m-5 px-5 position-relative">
        <div class="row">
            <div class="col">
                <div class="row prodotto-carrello gy-4">

                    @foreach ($restaurant->products as $product)
                        {{-- Componente per il singolo prodotto --}}
                        @if ($product->visible === 1)
                            <product-component @add-cart="AddNewCart" :product="{{ $product }}" class="product">
                            </product-component>
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="col col-lg-3">
                <cart-component @refresh-qty="refreshQty" :total="total" :cart="cart"></cart-component>
            </div>
        </div>
    </div>
@endsection
