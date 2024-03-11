<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/fontawesome-free-6.5.1/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    @endif
</head>

<body style="background-color: #232d48">


    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col">
            <div class="row justify-content-center mt-4">
                <a style="max-width: 128px" href="{{ route('index') }}"> <img
                        src="{{ asset('dashboard/assets/img/nwe_logo.png') }}" alt=""></a>
            </div>
            <div class="container p-1">
                <div class="row justify-content-center">
                    <div class="col-lg-6 rounded-3 border-danger bg-white px-3 py-5 shadow-sm ">

                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ __(Session::get('error')) }}
                            </div>
                        @endif

                        @yield('content')

                    </div>


                </div>

            </div>
        </div>


    </div>

    <script src="{{ asset('dashboard/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/script.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dateBirth').datepicker({
                format: 'yyyy-mm-dd',
                zIndexOffset: 99999999,
                startDate: '-80y',
                endDate: '-10y'

            });

        });
    </script>

</body>

</html>
