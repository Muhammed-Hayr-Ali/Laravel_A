@extends('admin.layouts.model_without_title')
@section('min-w', 'min-w-[40%]')
@section('max-h', 'max-h-[70vh] ')
@section('body')
    <!-- profile -->
    <div class=" relative w-full h-[126px] flex justify-center items-center">
        @if ($user->profile != null)
            <div class="w-full h-[126px] rounded-xl bg-center bg-cover" style="background-image: url({{ $user->profile }});">
            </div>
            <div class="absolute top-[13px]  z-10  h-[100px] w-[100px] rounded-full bg-white p-1">
                <img class="rounded-full h-full w-full" src="{{ $user->profile }}">
            </div>
        @else
            <div class="w-full h-[126px] rounded-xl bg-center bg-cover"
                style="background-image: url(https://ui-avatars.com/api/?background=random&name={{ $user->name }}?size=100&format=svg);">
            </div>
            <div class="absolute top-[13px] z-10  h-[100px] w-[100px] rounded-full bg-white p-1">

                <img class="rounded-full h-full w-full"
                    src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}?size=100&format=svg">
            </div>
        @endif

        <div class="absolute z-0 top-0 w-full h-[126px] rounded-xl  backdrop-blur-sm	"></div>
    </div>
    <!-- status -->
    <div
        class="w-full my-4 flex justify-center p-2 bg-secondary-50 rounded-xl text-secondary-900 text-base font-bold text-center">
        <p class="">{{ $user->status }}</p>
    </div>
    <!-- info -->

    <div class="w-full my-4 flex justify-center p-2 bg-secondary-50 rounded-xl text-base">
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


@endsection
@section('Close', trans('Close'))
@section('footer')
    <button value="{{ $user->id }}" id="processedButton" class="btn btn-primary bg-primary-700 text-white">
        <i class="fa-solid fa-user-pen"></i>
        {{ __('Edit user') }} </button>
@endsection
