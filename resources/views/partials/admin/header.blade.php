{{-- Questa è la nav con ristorante --}}
@if (Auth::user()->has_restaurant)
    <div class="nav">
        <input type="checkbox" name="" id="nav-check">


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


            <div class="container-link" style="display: flex;">
                @guest

                    <a href="{{ route('login') }}"> {{ __('Login') }} </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif

                @endguest
            </div>


        </div>
    </div>
@endif
