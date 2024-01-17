@guest
    <div class="relative">
        <button id="guestButton" class="flex flex-row space-x-1 items-center">
            <svg width="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                        stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
            <div class="hidden lg:flex flex-col items-start text-white text-xs">
                <p class=" font-semibold">Welcome</p>
                <p class="font-light">Sign in / Registe</p>
            </div>
        </button>

        <div id="guest" class="absolute flex flex-col items-center mt-2 left-[-100px] md:right-[-100px] z-20">
            <div class="triangle"></div>
            <div class=" p-4 bg-white flex flex-col items-center rounded-xl shadow-xl space-y-2 ">
                <button id="loginButton"
                    class="w-56 flex justify-center py-2 bg-black rounded-full text-white">login</button>
                <button id="registerButton" class="flex w-10 text-xs font-normal">Register</button>

            </div>
        </div>
    </div>
@endguest

<script src="{{ asset('assets/general/js/guest.js') }}"></script>
    <script>
        var guestButton = document.getElementById('guestButton');
        var guest = document.getElementById('guest');
        var timeoutId;

        guestButton.addEventListener('mouseover', function() {
            guest.style.opacity = 1;
            guest.style.transform = 'scale(1)';
            guest.style.pointerEvents = 'auto';
            clearTimeout(timeoutId);
        });

        guestButton.addEventListener('mouseout', function() {
            timeoutId = setTimeout(function() {
                guest.style.opacity = 0;
                guest.style.transform = 'scale(0.9)';
                guest.style.pointerEvents = 'none';
            }, 500);
        });

        guest.addEventListener('mouseover', function() {
            clearTimeout(timeoutId);
        });

        guest.addEventListener('mouseout', function() {
            timeoutId = setTimeout(function() {
                guest.style.opacity = 0;
                guest.style.transform = 'scale(0.9)';
                guest.style.pointerEvents = 'none';
            }, 500);
        });
    </script>
