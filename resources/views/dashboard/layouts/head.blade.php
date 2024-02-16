<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/fontawesome-free-6.5.1/css/all.css') }}">
    @yield('head')
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    @endif
</head>
