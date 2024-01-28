@php
    if (Auth::check() && Auth::user()->profile) {
        $userProfile = asset(Auth::user()->profile);
    } else {
        $userProfile = asset('dashboard/assets/img/user.png');
    }
    $unreadMessages = App\Models\Message::where('user_id', Auth::id())
        ->where('status', 'Unread')
        ->latest()
        ->limit(5)
        ->get();
    $unreadMessagesCount = App\Models\Message::where('user_id', Auth::id())
        ->where('status', 'Unread')
        ->count();
    if ($unreadMessagesCount > 99) {
        $unreadMessagesCount = '+99';
    }
@endphp
<div class="header">
    <div class="header-left active">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('dashboard/assets/img/logo.png') }}" alt="">
        </a>
        <a href="index.html" class="logo-small">
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
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ $userProfile }}" alt="">
                    {{-- <span class="status online"></span></span> --}}
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name ?? '' }}</h6>
                            <h5>{{ __(Auth::user()->role) ?? __('Guest') }}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="profile.html"> <i class="me-2"
                            data-feather="user"></i>{{ __(' My Profile') }}</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                            data-feather="settings"></i>{{ __('Settings') }}</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ route('logout') }}"><img
                            src="{{ asset('dashboard/assets/img/icons/log-out.svg') }}" class="me-2"
                            alt="img">{{ __('Logout') }}</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ asset('dashboard/assets/img/icons/messages.svg') }}" alt="img">
                <span class="badge rounded-pill">{{ $unreadMessagesCount }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">{{ __('Messages') }}</span>
                </div>
                <div class="noti-content">
                    <ul class="notification-list" id="unreadMessages">

                        {{-- unread Messages list --}}


                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">{{ __('View all Messages') }}'</a>
                </div>
            </div>
        </li>

        <li class="pt-[14px] px-2">
            @include('partials.language_switcher')
        </li>

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}"
                                    alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('dashboard/assets/img/icons/search.svg') }}"
                            alt="img"></a>
                </form>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a class="dropdown-item" href="signin.html">Logout</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        unreadMessages();

        function unreadMessages() {
            axios.get("{{ route('unreadMessages') }}", {
                "_token": '{{ csrf_token() }}',
            }).then(function(response) {
                $('#unreadMessages').html(response.data);
            });
        };

    })
</script>
