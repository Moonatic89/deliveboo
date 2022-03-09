@extends('layouts.app')

@section('content')
    <div class="container my-5 pt-5 text-center">
        <h3 class="mt-5 pt-3">Il tuo pagamento è stato effettuato con successo!</h3>
        <h4>A breve riceverai una mail per confermare il tuo ordine.</h4>
        <p>
            <a class="home-btn" href="{{ route('homepage') }}">Torna alla home</a>
        </p>
        <img src="{{ asset('./img/order.jpg') }}" width="700px">
    </div>
@endsection
