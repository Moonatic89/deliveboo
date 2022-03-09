{{-- Questa è la nav per l'utente con ristoranti --}}

<div class="nav Has block">
    <input type="checkbox" id="nav-check">

    <div class="logo">
    </div>

    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="container-lg container-fluid nav-links d-flex justify-content-between w-100">

        <div>
            <a href="/">Deliveboo</a>
            {{-- <a href="http://stackoverflow.com/users/4084003/" target="_blank"> utente (link inutili)</a> --}}
        </div>


        <div>
            @guest


                <a href="{{ route('login') }}"> {{ __('Login') }} </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

            @else

                <span>
                    @if (Auth::user()->has_restaurant)
                        <a href="{{ route('admin.restaurants.index') }}">
                            @if (Auth::user()->account_image)
                                <img class="w-5 rounded-circle"
                                    src="{{ asset('storage/account_image/' . Auth::user()->id . '/' . Auth::user()->account_image) }}"
                                    alt="{{ Auth::user()->name }}">
                            @else
                                <img class="w-5 rounded-circle" src="{{ url('/img/placeholder/placeholder_user.png') }}"
                                    alt="placeholder_user">
                            @endif
                            <span>{{ Auth::user()->name }}</span>

                        </a>
                    @else
                        <a href="{{ route('admin.register.create') }}">
                            @if (Auth::user()->account_image)
                                <img class="w-5 rounded-circle"
                                    src="{{ asset('storage/account_image/' . Auth::user()->id . '/' . Auth::user()->account_image) }}"
                                    alt="{{ Auth::user()->name }}">
                            @else
                                <img class="w-5 rounded-circle" src="{{ url('/img/placeholder/placeholder_user.png') }}"
                                    alt="placeholder_user">
                            @endif
                            <span>{{ Auth::user()->name }}</span>

                        </a>
                    @endif
                </span>



                <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                                                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endguest
        </div>

    </div>

</div>
