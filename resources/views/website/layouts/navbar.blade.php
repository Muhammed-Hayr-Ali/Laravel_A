    <nav>
        <div class="row px-3 align-items-center">
            <div class="col-auto">
                @if (Auth::check() && Auth::user()->role_id == 1)
                    <a href="{{ route('/index') }}">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('signin.index') }}">{{ __('Login') }}</a>
                @endif

            </div>
            <div class="col px-2">

            </div>
            <div class="col-auto">
                @if ($currentLocale == 'ar')
                    <a href="/language/en"><img src="{{ asset('dashboard/assets/img/flags/us.svg') }}" alt=""
                            height="16"></a>
                @else
                    <a href="/language/ar"><img src="{{ asset('dashboard/assets/img/flags/sa.svg') }}" alt=""
                            height="16"></a>
                @endif
            </div>


        </div>
    </nav>
