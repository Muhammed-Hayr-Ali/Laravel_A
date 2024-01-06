<div id="navbar" class="pt-3">
    <div class="flex flex-row w-full max-w-5xl items-center space-x-3">
        {{-- logo --}}
        @include('components.navbar.logo')
        {{-- search --}}
        @include('components.navbar.search')
        {{-- download --}}
        @include('components.navbar.download')
        {{-- guest --}}
        @include('components.navbar.guest')
        {{-- download --}}
        @include('components.navbar.user')

    </div>
    <p class="text-white">456</p>
</div>




<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-106px";
        }
        prevScrollpos = currentScrollPos;
    }
</script>
