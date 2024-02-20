<!DOCTYPE html>
<html lang="en">


@include('dashboard.layouts.head')




<body>
    <div id="global-loader">
        <div class="progress"> </div>
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
