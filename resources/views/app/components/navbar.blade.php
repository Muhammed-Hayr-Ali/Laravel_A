<div id="navbar" class="flex justify-center ">
    <div id="navbarContent">
    <div class="h-[60px] w-full flex items-center space-x-2">

    @include('app.components.navbar.components.logo')
    @include('app.components.navbar.components.Search')
    @include('app.components.navbar.components.download')
    @include('app.components.navbar.components.guest')
    @include('app.components.navbar.components.user')
    @include('app.components.navbar.components.cart')
    
    </div>
    {{-- <div class="h-[50px] w-full bg-red-800"></div> --}}
    </div>
</div>
