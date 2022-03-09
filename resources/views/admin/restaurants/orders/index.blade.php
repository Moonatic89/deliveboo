@extends('layouts.admin')

@section('personalCss')
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link href="{{ asset('css/restaurantEdit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="scroll">
        @if (!empty($orders))
            <div class="container mt-5 py-5">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>LAST_NAME</th>
                            <th>PHONE</th>
                            <th>EMAIL</th>
                            <th>ADDRESS</th>
                            <th>NOTES</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="row">{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->last_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->notes }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        @else
            <h1>non fatturi!</h1>
        @endif
    </div>
@endsection
