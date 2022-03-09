@extends('layouts.app')

@section('personalCss')
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
@endsection

@section('content')
    {{-- Jubmo container [video e herotext] --}}
    <div class="jumboContainer ">
        <video class="jumboVideo" autoplay loop muted>
            <source src="{{ asset('video/jumbotron.mp4') }}" type="video/mp4">
        </video>

        {{-- herotext --}}
        <div class="container h-100 d-flex align-items-center">
            <h1 class="text-capitalize Title text-light">serviamo tutti i piatti <span class="text-danger">caldi</span>
                <br> tranne il
                <span class="text-danger">sushi</span>
            </h1>

        </div>
    </div>

    <restaurants></restaurants>
    <steps></steps>
@endsection
