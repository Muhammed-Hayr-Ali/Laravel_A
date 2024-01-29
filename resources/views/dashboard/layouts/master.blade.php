<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.layouts.head')
    @yield('head')
    @vite('resources/css/app.css')
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">


        @include('dashboard.layouts.header')

        @include('dashboard.layouts.sidebar')

        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>


    @include('dashboard.layouts.script')

</body>

</html>
