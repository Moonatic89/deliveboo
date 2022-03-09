@extends('layouts.admin')

@section('content')
    <div class="container">
        @if ($user->account_image)
            <img src="{{ asset('storage/account_image/' . $user->id . '/' . $user->account_image) }}"
                alt="{{ $user->name }}">
        @else
            <img src="{{ url('/img/placeholder/placeholder_user.png') }}" alt="placeholder_user" class="w-25">
        @endif

        <h4>Benvenuto nella Dashboard: {{ $user->name }}</h4>
    </div>
@endsection
