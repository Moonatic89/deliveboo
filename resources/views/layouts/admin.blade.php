<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Deliveboo - Dashboard</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('personalCss')


</head>

<body>
    <div id="app">
        <div class="dashboard overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-none d-md-block sidebar">
                        <div class="sidebar-sticky pt-3">
                            <ul class="navbar text-light list-unstyled ul-sidebar flex-column">
                                @if (Auth::user()->has_restaurant)
                                    <li class="nav-item user-info d-flex justify-content-center align-items-center mb-4">
                                        @if (Auth::user()->account_image)
                                            <img src="{{ asset('storage/account_image/' . Auth::user()->id . '/' . Auth::user()->account_image) }}"
                                                alt="{{ Auth::user()->name }}" width="50px" height="50px"
                                                class="rounded-circle" style="object-fit: cover">
                                        @else
                                            <img src="{{ url('/img/placeholder/placeholder_user.png') }}" width="50px"
                                                height="50px" class="rounded-circle">
                                        @endif
                                        <h4 class="ms-3">{{ Auth::user()->name }}</h4>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.restaurants.index') }}">
                                            <i class="fas fa-house-user"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('homepage') }}">
                                            <i class="fas fa-home"></i>
                                            Homepage
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('admin.register.create') }}" class="fw-bold">
                                            <i class="fa fa-plus"></i>
                                            Crea il primo ristorante
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                    <main role="main" class="col px-0 dashboardJumbo">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>
