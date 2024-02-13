<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/auth/img/favicon.png') }}" sizes="32x32" type="image/png">
    <!-- custom.css -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/custom.css') }}">
  <!-- Font Awesome 6.5.1 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <!-- Theme style -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- .google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    @yield('style')
    @vite('resources/css/app.css')
</head>

<body>


    <div class="h-[99vh] w-screen flex flex-col   justify-center items-center">
        <div class="flex flex-auto items-end"><a href="/"><img class="h-20 w-20" src="{{ $data['logo'] }}"
                    alt="logo"></a></div>
        <div class="flex flex-auto items-center">

            @yield('content')



        </div>
        <div class="flex flex-auto items-end text-white text-xs">© {{ $data['year'] }} {{ $data['siteName'] }}, Inc.
        </div>
    </div>

    @yield('script')
</body>

</html>
