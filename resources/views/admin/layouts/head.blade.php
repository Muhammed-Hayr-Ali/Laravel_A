<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<title>@yield('title')</title>
{{-- https://fontawesome.com/v5/search?q=out&o=r&m=free --}}
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Font Awesome 6.5.1 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/mycustomstyle.css') }}">

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.5/axios.min.js"
    integrity="sha512-TjBzDQIDnc6pWyeM1bhMnDxtWH0QpOXMcVooglXrali/Tj7W569/wd4E8EDjk1CwOAOPSJon1VfcEt1BI4xIrA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- toastr -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
<script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>



<!-- .google fonts -->
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">

@yield('head')
