@php
    $user = Auth::user();
    $currentLocale = app()->getLocale();
@endphp

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $settings['siteName'] }}</title>
    <meta name="description" content="Marketna Store">
    <link rel="icon" href="{{ asset($settings['black_logo']) }}" sizes="32x32" type="image/png">
    <!-- custom.css -->
    <!-- bootstrap.min.css -->
    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
    <!-- font-awesome -->
    <link rel="stylesheet" href="{{ asset('website/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- google-font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.css') }}">

    <!-- AOS -->
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @if ($currentLocale == 'ar')
        <link rel="stylesheet" href="{{ asset('website/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    @endif

</head>

<body>


    <!-- nav -->
    @include('website.layouts.navbar')
    <!-- banner -->
    @include('website.layouts.banner')
    <!-- three-blcok -->
    @include('website.layouts.three-blcok')
    <!-- feature (skew background) -->
    @include('website.layouts.feature')
    <!-- price table -->
    {{-- <div class="container my-5 py-2" id="price-table">
        <h2 class="text-center font-weight-bold d-block mb-3">Check our pricing</h2>
        <div class="row">
            <div data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5">
                <h4 class="my-4">STARTUP</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">0</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Up to 5 Documents</li>
                    <li>Up to 3 Reviews</li>
                    <li>5 team Members</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Get Free</a>
            </div>
            <div data-aos="fade-up" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5 rounded" id="price-table__premium">
                <h4 class="my-4">PREMIUM</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">10</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Up to 15 Documents</li>
                    <li>Up to 10 Reviews</li>
                    <li>25 team Members</li>
                    <li>Limited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-green">Get Free</a>
            </div>
            <div data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000" data-aos-once="true"
                class="col-md-4 text-center py-4 mt-5">
                <h4 class="my-4">PROFESSIONAL</h4>
                <p class="font-weight-bold">$ <span class="display-2 font-weight-bold">30</span> / MO.</p>
                <ul class="list-unstyled">
                    <li>Unlimited Documents</li>
                    <li>Unlimited Reviews</li>
                    <li>Unlimited Members</li>
                    <li>Unlimited Support</li>
                </ul>
                <a href="#" class="btn my-4 font-weight-bold atlas-cta cta-ghost">Get Free</a>
            </div>
        </div>
    </div> --}}
    <!-- client -->
    @include('website.layouts.client')

    <!-- contact -->
    @include('website.layouts.contact')

    <!-- copyright -->
    <div class="" id="copyright">

        {{-- <div class="row justify-content-between">
                <div class="col-md-6 text-white align-self-center text-center text-md-left my-2">
                    Copyright © 2018 Chen, Yi-Ya.
                </div>
                <div class="col-md-6 align-self-center text-center text-md-right my-2" id="social-media">
                    <a href="#" class="d-inline-block text-center ml-2">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                        <i class="fa fa-medium" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="d-inline-block text-center ml-2">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                </div>
            </div> --}}

        <div class="col">
            <div class="row justify-content-center py-3 " id="social-media">


                <a href="{{ $settings['twitter'] }}" class="d-inline-block text-center ml-2">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>

                <a href="{{ $settings['github'] }}" class="d-inline-block text-center ml-2">
                    <i class="fa fa-github" aria-hidden="true"></i>
                </a>

                <a href="{{ $settings['android'] }}" class="d-inline-block text-center ml-2">
                    <i class="fa fa-android" aria-hidden="true"></i>
                </a>



            </div>
            <p class="text-center">© {{ $settings['year'] }} PST, Inc</p>
        </div>

    </div>

    <!-- AOS -->
    <script src="{{ asset('website/js/aos.js') }}"></script>
    <script>
        AOS.init({});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
