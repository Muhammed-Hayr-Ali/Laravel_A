<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/logo.png') }}" class="brand-image">
        <span class="brand-text font-weight-light">{{ __('Admin') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 flex flex-row items-center">
            <img class="rounded-full" src="{{ asset(Auth::user()->profile) }}">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">



                <li class="nav-item">
                    <a href="{{ route('index') }}" class="@yield('Home') nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p>{{ __('Home') }}</p>
                    </a>
                </li>


                <!-- Orders  -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link @yield('Orders') ">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>
                            {{ __('Orders') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{ route('pendings') }}" class="nav-link @yield('Pending') ">
                                <i class="fa-solid fa-hourglass-start"></i>
                                <p>{{ __('Pendings') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('others') }}" class="nav-link @yield('Others') ">
                                <i class="fa-solid fa-truck-fast"></i>
                                <p>{{ __('Others') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Categories  -->

                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="@yield('Categories') nav-link">
                        <i class="fa-solid fa-layer-group"></i>
                        <p>{{ __('Categories') }}</p>
                    </a>
                </li>

                <!-- Orders  -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
