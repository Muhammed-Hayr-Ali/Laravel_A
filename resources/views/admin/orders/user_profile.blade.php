<div class="relative">

    <div class="relative re w-full flex justify-center mt-2 ">
        @if ($user->profile != null)
            <div class="w-[95%] h-[125px] rounded-xl bg-center bg-cover"
                style="background-image: url({{ $user->profile }});">
            </div>
        @else
            <div class="w-[95%] h-[125px] rounded-xl bg-center bg-cover"
                style="background-image: url(https://ui-avatars.com/api/?background=random&name={{ $user->name }}?size=100&format=svg);">
            </div>
        @endif
        <div class="w-[95%] absolute top-0 h-[124px]  rounded-xl  flex justify-center backdrop-blur-sm	"></div>
    </div>




    <div class="absolute top-0 w-full flex flex-col items-center pt-[75px]">

        <div class="bg-white p-1 rounded-full">

            @if ($user->profile != null)
                <img class="rounded-full h-[100px] w-[100px]" src="{{ $user->profile }}">
            @else
                <img class="rounded-full h-[100px] w-[100px]"
                    src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}?size=100&format=svg">
            @endif
        </div>



        <p class="text-base font-bold text-center">{{ $user->name }}</p>


        <div
            class="w-[95%] my-4 flex justify-center p-2 bg-secondary-50 rounded-xl text-secondary-900 text-base font-bold text-center">
            <p class="">{{ $user->status }}</p>
        </div>




        <div class="w-[95%] my-4 flex justify-center p-2 bg-secondary-50 rounded-xl text-base">
            <thead class="">
                <table class="w-full ">

                    <tbody class="">
                        <tr class="border-b border-secondary-100">
                            <td class="py-2 px-2 text-center font-bold">{{ __('Role') }}</td>
                            <td class="py-2 px-2">{{ __($user->role) }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Email') }}</td>
                            <td class="py-2 px-2">{{ $user->email }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Phone Number') }}</td>
                            <td class="py-2 px-2 ">{{ $user->phone_number }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Date Birth') }}</td>
                            <td class="py-2 px-2">{{ $user->date_birth }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Date of Registration') }}</td>
                            <td class="py-2 px-2">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Gender') }}</td>
                            <td class="py-2 px-2">{{ __($user->gender) }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Orders Count') }}</td>
                            <td class="py-2 px-2">{{ $user->orders->count() }}</td>
                        </tr>

                        <tr class="border-b border-secondary-100">
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Cart items') }}</td>
                            @if ($user->cart != null)
                                <td class="py-2 px-2">{{ $user->cart->cartItems->count() }}</td>
                            @else
                                <td class="py-2 px-2">0</td>
                            @endif
                        </tr>
                        <tr>
                            <td class=" py-2 px-2 text-center font-bold">{{ __('Comments') }}</td>
                            <td class="py-2 px-2">{{ $user->comments->count() }}</td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
</div>
