@auth
    <div class="relative">

        <div id="cartButton" class="flex flex-col items-center h-full">

                <div class="h-5 w-5 flex justify-center items-center text-xs bg-white rounded-full  tahoma">
                    {{ Auth::user()->cart->cartItems->count() }}</div>







            <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">

                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                <g id="SVGRepo_iconCarrier">
                    <title>Shopping-cart</title>
                    <g id="🖥-Landing" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Artboard" transform="translate(-74.000000, -239.000000)">
                            <g id="Shopping-cart" transform="translate(74.000000, 239.000000)">
                                <rect id="Rectangle" x="0" y="0" width="24" height="24"> </rect>
                                <path
                                    d="M2.5,3.5 L4.57364,3.5 C4.81929,3.5 5.02855,3.67844 5.06736,3.921 L6.73058,14.3158 C6.88582,15.286 7.72287,15.9998 8.70546,15.9998 L17.3957,15.9998 C18.3331,15.9998 19.1447,15.3487 19.3481,14.4337 L20.7296,8.21674 C20.8684,7.59222 20.3932,6.9998 19.7534,6.9998 L5.83997,6.9998"
                                    id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </path>
                                <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                    cx="9.5" cy="21" r="1"> </circle>
                                <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                    cx="16.5" cy="21" r="1"> </circle>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>


        </div>
@if(Auth::user()->cart->cartItems->count() > 0)
    
        <div id="cart" class="absolute flex flex-col items-center mt-2 flex-auto left-[-100px] md:right-[-100px] z-30">
            <div class="triangle"></div>
            <div class=" bg-white shadow-xl rounded-2xl px-0.5 py-2 w-72 ">
                <div class=" max-h-[400px] w-full  scroll  focus:scroll-auto overflow-auto ">
                    <div class="bg-slate-100 w-auto h-fullb mt-2 mb-5 mr-[1px] ml-[4px] p-3 rounded-2xl space-y-5">

                        @foreach (Auth::user()->cart->cartItems->pluck('product')->groupBy('name') as $name => $products)
                            <div class=" w-full flex space-x-2">
                                @if ($products->first()->images()->exists())
                                    <img class="w-20 h-20 min-w-20 min-h-20 rounded-md"
                                        src="{{ $products->first()->images()->first()->url }}" alt="{{ $name }}"
                                        style="object-fit: fill ;">
                                @else
                                    <div class="w-20 h-20 bg-slate-200 rounded-md">
                                        <svg width="80px" height="80px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M4.46814 17.5319C5.62291 19.7154 7.92876 20.5 12 20.5C17.6255 20.5 19.8804 19.002 20.3853 14.3853M4.46814 17.5319C3.77924 16.2292 3.5 14.4288 3.5 12C3.5 5.5 5.5 3.5 12 3.5C18.5 3.5 20.5 5.5 20.5 12C20.5 12.8745 20.4638 13.6676 20.3853 14.3853M4.46814 17.5319L7.58579 14.4142C8.36684 13.6332 9.63317 13.6332 10.4142 14.4142L10.5858 14.5858C11.3668 15.3668 12.6332 15.3668 13.4142 14.5858L15.5858 12.4142C16.3668 11.6332 17.6332 11.6332 18.4142 12.4142L20.3853 14.3853M10.691 8.846C10.691 9.865 9.864 10.692 8.845 10.692C7.827 10.692 7 9.865 7 8.846C7 7.827 7.827 7 8.845 7C9.864 7 10.691 7.827 10.691 8.846Z"
                                                    stroke="#a0a0a0" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex flex-col max-h-20">
                                    <div class="text-xs flex items-center">{{ $name }}</div>
                                    <div class="h-12 flex items-center text-[#999999]  tahoma text-[11px]">
                                        quantity: {{ $products->count() }}</div>
                                    <div class="h-12 flex items-center color tahoma text-[12px]">
                                        {{ $products->first()->price }}$</div>
                                </div>
                            </div>
                            <hr>
                        @endforeach    




                    </div>


                    <div class="flex flex-row justify-center space-x-2  my-5">
                        <button class="button-white ">check out</button>
                        <button class="button-primary">check out</button>
                    </div>


                </div>


            </div>
        </div>
@endif


    </div>
@endauth

@guest
    <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">

        <g id="SVGRepo_bgCarrier" stroke-width="0" />

        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

        <g id="SVGRepo_iconCarrier">
            <title>Shopping-cart</title>
            <g id="🖥-Landing" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Artboard" transform="translate(-74.000000, -239.000000)">
                    <g id="Shopping-cart" transform="translate(74.000000, 239.000000)">
                        <rect id="Rectangle" x="0" y="0" width="24" height="24"> </rect>
                        <path
                            d="M2.5,3.5 L4.57364,3.5 C4.81929,3.5 5.02855,3.67844 5.06736,3.921 L6.73058,14.3158 C6.88582,15.286 7.72287,15.9998 8.70546,15.9998 L17.3957,15.9998 C18.3331,15.9998 19.1447,15.3487 19.3481,14.4337 L20.7296,8.21674 C20.8684,7.59222 20.3932,6.9998 19.7534,6.9998 L5.83997,6.9998"
                            id="Path" stroke="#ffffff" stroke-width="2" stroke-linecap="round"> </path>
                        <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="9.5"
                            cy="21" r="1"> </circle>
                        <circle id="Oval" stroke="#ffffff" stroke-width="2" stroke-linecap="round" cx="16.5"
                            cy="21" r="1"> </circle>
                    </g>
                </g>
            </g>
        </g>
    </svg>
@endguest


<script>
    var cartButton = document.getElementById('cartButton');
    var cart = document.getElementById('cart');
    var timeoutId;

    cartButton.addEventListener('mouseover', function() {
        cart.style.opacity = 1;
        cart.style.transform = 'scale(1)';
        cart.style.pointerEvents = 'auto';
        clearTimeout(timeoutId);
    });

    cartButton.addEventListener('mouseout', function() {
        timeoutId = setTimeout(function() {
            cart.style.opacity = 0;
            cart.style.transform = 'scale(0.9)';
            cart.style.pointerEvents = 'none';
        }, 500);
    });

    cart.addEventListener('mouseover', function() {
        clearTimeout(timeoutId);
    });

    cart.addEventListener('mouseout', function() {
        timeoutId = setTimeout(function() {
            cart.style.opacity = 0;
            cart.style.transform = 'scale(0.9)';
            cart.style.pointerEvents = 'none';
        }, 500);
    });
</script>
