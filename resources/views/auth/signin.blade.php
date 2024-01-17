@extends('auth.layouts.master')
@section('title', trans('Sign in'))
@section('content')
    <form action="{{ route('signin.store') }}" method="POST">
        @csrf
        <div class="flex flex-col  items-center space-y-6 ">
            @if (Session::has('error'))
                <div id="errors" class="flex w-full   bg-red-200 rounded-md  flex-row items-center p-3 text-red-800">
                    <p id="errorMessage" class="w-full text-right px-3">{{ __(Session::get('error')) }}</p>
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
            @endif
            <div class="space-x-2 input px-2">
                <input id="email" type="text" name="email" placeholder="{{ __('Email') }}" autocomplete="email"
                    value="{{ old('email') }}">
                <i class="fa-solid fa-at text-slate-600"></i>
            </div>



            <div class="space-x-2 input px-2">
                <div class="w-5">
                    <button id="showPassword" class="text-slate-600"> <i class="fa-solid fa-eye"></i></button>
                    <button id="hidePassword" class="hidden text-slate-600"> <i
                            class="fa-solid fa-eye-slash"></i></i></button>
                </div> <input id="password" type="password" name="password" placeholder="{{ __('Password') }}"
                    autocomplete="new-password" value="{{ old('password') }}">

                <i class="fa-solid fa-lock text-slate-600"></i>
            </div>

            <div class="w-full flex justify-center space-x-2  text-sm text-slate-100">
                <a href="{{ route('forgotPassword.index') }}">{{ __('Forgot Password') }}</a>
                <p>|</p>
                <a href="{{ route('signup.index') }}">{{ __('Sign up') }}</a>


            </div>

            <button type="submit"
                class="submit bg-primaryColor-500 font-semibold text-[#0c2440]">{{ __('Sign in') }}</button>
        </div>

    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#showPassword').click(function() {
                event.preventDefault();

                $('#password').prop('type', 'text');
                $('#showPassword').hide();
                $('#hidePassword').show();
            });



            $('#hidePassword').click(function() {
                event.preventDefault();

                $('#password').prop('type', 'password');
                $('#hidePassword').hide();
                $('#showPassword').show();
            });



        });
    </script>
@endsection
