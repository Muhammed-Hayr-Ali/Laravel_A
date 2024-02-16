@extends('auth.layouts.master')
@section('title', trans('sign in'))
@section('content')
    <form id="form" action="{{ route('signin.store') }}" method="POST">
        @csrf




        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>






        <div class="form-group">
            <label>{{ __('Password') }}</label>
            <div class="pass-group">
                <input type="password" class=" pass-input" name="password" value="{{ old('password') }}">
                <span class="fas toggle-password fa-eye-slash"></span>
            </div>
        </div>

        <div class="row justify-content-center pt-3 ">
            <div class="col-auto m-0 p-0"><a href="#">{{ __('Forgot Password') }}</a></div>
            <div class="col-auto">|</div>
            <div class="col-auto m-0 p-0"> <a href="{{ route('signup.index') }}">{{ __('Create New Account') }}</a>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button style="height: 40px" id="submit" type="submit" class="btn btn-submit mt-5"
                type="button">{{ __('sign in') }}</button>
        </div>


    </form>
@endsection
