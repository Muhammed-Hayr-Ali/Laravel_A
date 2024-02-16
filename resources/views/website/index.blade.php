@php
    $currentLocale = app()->getLocale();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Template Atlas</title>
    <meta name="description" content="Free bootstrap template Atlas">
    <link rel="icon" href="{{ asset('website/img/favicon.png') }}" sizes="32x32" type="image/png">
    <!-- font-awesome -->
    <link rel="stylesheet" href="{{ asset('website/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- bootstrap.min.css -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <!-- AOS -->
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">
    <!-- AOS -->
    <link rel="stylesheet" href="{{ asset('website/css/animate.css') }}">
    <!-- custom.css -->
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('website/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    @endif
</head>

<body>

    <nav class="nav">
        <div class="menu">
            <div class="nav-item dropdown">
                <a class="nav-item" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
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
                <ul class="dropdown-menu">
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
                </ul>
            </div>
            @if (Auth::check() && Auth::user())

                @if (Auth::user()->role_id == 1)
                    <a class="nav-item" href="{{ route('/index') }}">{{ __('Dashboard') }}</a>
                @else
                    <a class="nav-item">{{ __('Welcome  ' . Auth::user()->name) }}</a>
                @endif
            @else
                <a class="nav-item" href="{{ route('signin.index') }}">{{ __('Login') }}</a>

            @endif

        </div>

    </nav>


    <!-- banner -->
    <div class="jumbotron jumbotron-fluid" id="banner"
        style="background-image: url({{ asset('website/img/banner-bk.jpg') }});">
        <div class="container text-center text-md-left">
            <header>
                <div class="row justify-content-between">
                    <div class="col-2">
                        <img src="{{ asset($settings['logo']) }}" alt="logo">
                    </div>
                    <div class="col-6 align-self-center text-right">
                        {{-- <a href="#" class="text-white lead">Get Early Access</a> --}}
                    </div>
                </div>
            </header>
            <h1 data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
                class="display-3 text-white font-weight-bold my-5">
                {{ __($settings['big_title_1']) }}<br>
                {{ __($settings['big_title_2']) }}
            </h1>
            <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
                class="lead text-white my-4">
                {{ __($settings['sm_title_1']) }}
                <br>
                {{ __($settings['sm_title_2']) }}
            </p>
            <a href="{{ asset($settings['button_link']) }}" data-aos="fade" data-aos-easing="linear"
                data-aos-duration="1000" data-aos-once="true"
                class="btn my-4 font-weight-bold atlas-cta cta-green">{{ __($settings['button']) }}</a>
        </div>
    </div>
    <!-- three-blcok -->
    <div class="container my-5 py-2">
        <h2 class="text-center font-weight-bold my-5">{{ __($settings['three_blcok']) }}</h2>
        <div class="row">
            <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_1']) }}" alt="Anti-spam" class="mx-auto">
                <h4>{{ __($settings['title_1']) }}</h4>
                <p>{{ __($settings['sub_title_1']) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_2']) }}" alt="Phishing Detect" class="mx-auto">
                <h4>{{ __($settings['title_2']) }}</h4>
                <p>{{ __($settings['sub_title_2']) }}</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center">
                <img src="{{ asset($settings['image_3']) }}" alt="Smart Scan" class="mx-auto">
                <h4>{{ __($settings['title_3']) }}</h4>
                <p>{{ __($settings['sub_title_3']) }}</p>
            </div>
        </div>
    </div>
    <!-- feature (skew background) -->
    <div class="jumbotron jumbotron-fluid feature" id="feature-first">
        <div class="container my-5">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="col-md-6">
                    <h2 class="font-weight-bold">{{ __($settings['feature_1_title']) }}</h2>
                    <p class="my-4">{{ __($settings['feature_1_text_1']) }}
                        <br> {{ __($settings['feature_1_text_2']) }}
                    </p>
                    <a href="{{ $settings['link_1'] }}"
                        class="btn my-4 font-weight-bold atlas-cta cta-blue">{{ __($settings['button_1']) }}</a>
                </div>
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true"
                    class="col-md-6 align-self-center">
                    <img src="{{ asset($settings['feature_1_image']) }}" alt="Take a look inside"
                        class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>
    <!-- feature (green background) -->
    <div class="jumbotron jumbotron-fluid feature" id="feature-last">
        <div class="container">
            <div class="row justify-content-between text-center text-md-left">
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-once="true"
                    class="col-md-6 flex-md-last">
                    <h2 class="font-weight-bold">{{ __($settings['feature_2_title']) }}</h2>
                    <p class="my-4">
                        {{ __($settings['feature_2_text_1']) }}
                        <br>
                        {{ __($settings['feature_2_text_2']) }}
                    </p>
                    <a href="{{ $settings['link_2'] }}"
                        class="btn my-4 font-weight-bold atlas-cta cta-blue">{{ __($settings['button_2']) }}</a>
                </div>
                <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true"
                    class="col-md-6 align-self-center flex-md-first">
                    <img src="{{ asset($settings['feature_2_image']) }}" alt="Safe and reliable"
                        class="mx-auto d-block">
                </div>
            </div>
        </div>
    </div>


    <!-- client -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row justify-content-center ">

                @if (isset($settings['client_logo_1']) && $settings['client_logo_1'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_1']) }}" class="mx-auto d-block">
                    </div>
                @endif


                @if (isset($settings['client_logo_2']) && $settings['client_logo_2'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_2']) }}" class="mx-auto d-block">
                    </div>
                @endif
                @if (isset($settings['client_logo_3']) && $settings['client_logo_3'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_3']) }}" class="mx-auto d-block">
                    </div>
                @endif
                @if (isset($settings['client_logo_4']) && $settings['client_logo_4'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_4']) }}" class="mx-auto d-block">
                    </div>
                @endif
                @if (isset($settings['client_logo_5']) && $settings['client_logo_5'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_5']) }}" class="mx-auto d-block">
                    </div>
                @endif
                @if (isset($settings['client_logo_6']) && $settings['client_logo_6'] != null)
                    <div class="col-sm-4 col-md-2 py-2 align-self-center">
                        <img src="{{ asset($settings['client_logo_6']) }}" class="mx-auto d-block">
                    </div>
                @endif


            </div>
        </div>
    </div>
    <!-- contact -->
    <div class="jumbotron jumbotron-fluid" id="contact"
        style="background-image: url({{ asset('website/img/contact-bk.jpg') }});">
        @if (app()->getLocale() == 'ar')
            <div class="container" style="direction: rtl">
            @else
                <div class="container">
        @endif
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <h2 class="font-weight-bold pb-5 text-center text-white ">{{ __('Contact Us') }}</h2>

                <form id="form" action="{{ route('send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('Your Name') }}</label>
                            <input type="name" class="form-control" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">{{ __('Message') }}</label>
                        <textarea class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <button type="submit"
                        class="btn font-weight-bold atlas-cta atlas-cta-wide cta-green my-3">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- copyright -->
    <div class="jumbotron jumbotron-fluid" id="copyright">
        <div class="container">

            <div class="row justify-content-center pb-3 " id="social-media">

                @if (isset($settings['twitter']) && $settings['twitter'] != null)
                    <a href="{{ $settings['twitter'] }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                @endif



                @if (isset($settings['github']) && $settings['github'] != null)
                    <a href="{{ $settings['github'] }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-github" aria-hidden="true"></i>
                    </a>
                @endif


                @if (isset($settings['android']) && $settings['android'] != null)
                    <a href="{{ $settings['android'] }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-android" aria-hidden="true"></i>
                    </a>
                @endif

                @if (isset($settings['facebook']) && $settings['facebook'] != null)
                    <a href="{{ $settings['facebook'] }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </a>
                @endif



                @if (isset($settings['youtube']) && $settings['youtube'] != null)
                    <a href="{{ $settings['youtube'] }}" class="d-inline-block text-center ml-2">
                        <i class="fa fa-youtube-play" aria-hidden="true"></i> </a>
                @endif








            </div>
            <div class="row justify-content-center ">

                <div class="col-md-6 text-white align-self-center text-white  text-center my-2">
                    <p> ©
                        {{ $settings['year'] }} PST, Inc
                    </p>
                </div>


            </div>
        </div>
    </div>

    <!-- AOS -->
    <script src="{{ asset('website/js/aos.js') }}"></script>
    <script>
        AOS.init({});
    </script>

    <script src="{{ asset('dashboard/assets/js/axios.1.6.5.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/script.js') }}"></script>

</body>

</html>
