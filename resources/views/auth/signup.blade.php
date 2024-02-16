@extends('auth.layouts.master')
@section('title', trans('Create New Account'))
@section('content')
    <form id="form" action="{{ route('signup.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('Phone Number') }}</label>
                    <input type="text" class="en" name="phoneNumber" id="phoneNumber"
                        value="{{ old('phoneNumber') }}" placeholder="0933333333" maxlength="16"
                        oninput="this.value = this.value.replace(/[^0-9+-]/g, '').replace(/(\.*)\./g, '$1');" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>



        <div class="row">

            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <div class="pass-group">
                        <input type="password" class=" pass-input" name="password" id="password"
                            value="{{ old('password') }}">
                        <span class="fas toggle-password fa-eye-slash"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <div class="pass-group">
                        <input type="password" class="pass-inputs" name="Confirm_Password" id="Confirm_Password"
                            value="{{ old('Confirm_Password') }}">
                        <span class="fas toggle-passworda fa-eye-slash"></span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('addUser.Gender') }}</label>

                    <select class="select" name="gender" id="gender">

                        <option value="Unspecified" @if (old('gender') == 'Unspecified') selected @endif>
                            {{ __('Unspecified') }}</option>

                        <option value="Male" @if (old('gender') == 'Male') selected @endif>{{ __('Male') }}
                        </option>




                        <option value="Female" @if (old('gender') == 'Female') selected @endif>{{ __('Female') }}
                        </option>



                    </select>
                    <p id="genderError"></p>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>{{ __('Date Birth') }}</label>
                    <div class="input-groupicon">
                        <input type="text" placeholder="YYYY-MM-DD" name="dateBirth" id="dateBirth"
                            value="{{ old('dateBirth') }}">
                        <div class="addonset">
                            <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}" alt="img">
                        </div>
                    </div>
                    <p id="dateBirthError"></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label> {{ __('Profile Picture') }}</label>
                <div class="image-upload" id="profile">
                    <input type="file" name="profile"accept=".jpg, .jpeg, .png" id="profileImage">
                    <div class="image-uploads">
                        <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                        <h4>{{ __('Drag and drop a file to upload') }}</h4>
                    </div>
                </div>
                <p id="profileError"></p>
            </div>
        </div>
        <div class="row justify-content-center pt-3 ">
            <div class="col-auto m-0 p-0"><a href="#">{{ __('Forgot Password') }}</a></div>
            <div class="col-auto">|</div>
            <div class="col-auto m-0 p-0"> <a href="{{ route('signin.index') }}">{{ __('sign in') }}</a>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button style="height: 40px" id="submit" type="submit" class="btn btn-submit mt-5"
                type="button">{{ __('Create New Account') }}</button>
        </div>


    </form>
@endsection
