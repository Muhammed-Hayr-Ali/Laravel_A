@php
    $user = Auth::user();
    $currentLocale = app()->getLocale();
    $Messages = \App\Models\Message::all();

@endphp

<div class="header">
    <div class="header-left active">
        <a href="{{ route('/index') }}" class="logo">
            <img src="{{ asset('dashboard/assets/img/logo.png') }}" alt="">
        </a>
        <a href="{{ route('/index') }}" class="logo-small">
            <img src="{{ asset('dashboard/assets/img/logo-small.png') }}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="{{ __('header.Search Here ...') }}">
                        <div class="search-addon">
                            <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('dashboard/assets/img/icons/search.svg') }}"
                            alt="img"></a>
                </form>
            </div>
        </li>



        <li class="nav-item dropdown has-arrow flag-nav">

            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">

                @switch($currentLocale)
                    @case('ar')
                        <img src="{{ asset('dashboard/assets/img/flags/sa.svg') }}" alt="" height="20">
                    @break

                    @case('en')
                        <img src="{{ asset('dashboard/assets/img/flags/us.svg') }}" alt="" height="20">
                    @break

                    @case('tr')
                        <img src="{{ asset('dashboard/assets/img/flags/tr.svg') }}" alt="" height="20">
                    @break

                    @case('ku')
                        <img src="{{ asset('dashboard/assets/img/flags/iq.svg') }}" alt="" height="20">
                    @break

                    @default
                @endswitch
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="/language/ar" class="dropdown-item">
                    <img src="{{ asset('dashboard/assets/img/flags/sa.svg') }}" alt="" height="16"> عربي
                </a>
                <a href="/language/en" class="dropdown-item">
                    <img src="{{ asset('dashboard/assets/img/flags/us.svg') }}" alt="" height="16">
                    English
                </a>
                <a href="/language/tr" class="dropdown-item">
                    <img src="{{ asset('dashboard/assets/img/flags/tr.svg') }}" alt="" height="16">
                    Türkçe
                </a>
                <a href="/language/ku" class="dropdown-item">
                    <img src="{{ asset('dashboard/assets/img/flags/iq.svg') }}" alt="" height="16">
                    kurdî
                </a>
            </div>




        <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ asset('dashboard/assets/img/icons/notification-bing.svg') }}" alt="img"> <span
                    class="badge rounded-pill">{{ $Messages->count() }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">{{ __('header.Notifications') }}</span>
                    <a href="javascript:void(0)" class="clear-noti"> {{ __('header.Clear All') }} </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">

                        @foreach ($Messages as $Message)
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt=""
                                                src="{{ asset('dashboard/assets/img/icons/avatar.png') }}">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span
                                                    class="noti-title">{{ $Message->name }}</span>
                                                <span class="noti-title">{{ $Message->message }}</span>
                                            </p>
                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $Message->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach



                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">{{ __('header.View all Notifications') }}</a>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                @if ($user->profile)
                    <span class="user-img"><img src="{{ asset($user->profile) }}" alt="">
                        {{-- <span class="status online"></span> --}}</span>
                @endif

            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        {{-- <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="">
                            <span class="status online"></span></span> --}}
                        <div class="profilesets">
                            <h6>{{ $user->name }}</h6>
                            <h5>{{ $user->role->name }}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{ route('User.edit', ['User' => $user->id]) }}"> <i
                            class="me-2" data-feather="user"></i>{{ __('header.My Profile') }}</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                            data-feather="settings"></i>{{ __('header.Settings') }}</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"><img
                            src="{{ asset('dashboard/assets/img/icons/log-out.svg') }}" class="me-2"
                            alt="img">{{ __('header.Logout') }}</a>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-user"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item"
                href="{{ route('User.edit', ['User' => $user->id]) }}">{{ __('header.My Profile') }}</a>
            <a class="dropdown-item" href="generalsettings.html">{{ __('header.Settings') }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('header.Logout') }}</a>
        </div>
    </div>

</div>
