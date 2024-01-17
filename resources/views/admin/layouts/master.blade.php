<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    @include('admin.layouts.head')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->

        @include('admin.layouts.navbar')

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        @include('admin.layouts.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('admin.layouts.content-header')
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('admin.layouts.control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

        @include('admin.layouts.main-footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('admin.layouts.scripts')
</body>

</html>
