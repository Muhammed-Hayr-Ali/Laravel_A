@guest
    <div x-data="{ showBanner: false }" x-init="showBanner = false" class="relative">
        <button @mouseenter="showBanner = true" @mouseleave="showBanner = false" class="pw-32 flex flex-row space-x-1">
            <div class="flex flex-row space-x-1 items-center">
                <svg width="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <div class="flex flex-col items-start text-white text-xs">
                    <p class="font-semibold">Welcome</p>
                    <p class="font-light">Sign in / Registe</p>

                </div>
            </div>
        </button>


        <div @mouseenter="showBanner = true" @mouseleave="showBanner = false"
            class="absolute top-12 left-1/2 transform -translate-x-1/2 flex-auto" x-show="showBanner"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter="transition duration-200 transform ease"
            x-transition:leave="transition duration-200 transform ease" x-transition:leave-end="opacity-0 scale-90">



            <div class="flex flex-col items-center">
                <div class="triangle"></div>


                <div class="flex flex-auto  bg-white rounded-xl shadow-xl p-4">

                    <div class="flex flex-col items-center space-y-2 ">
                        <button id="loginButton"
                            class="w-56 flex justify-center py-2 bg-black rounded-full text-white">login</button>
                        <button id="registerButton" class="flex w-10 text-xs font-normal">Register</button>
                    </div>


                </div>







            </div>


        </div>
    </div>






@endguest
