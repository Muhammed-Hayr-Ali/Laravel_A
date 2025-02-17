@extends('dashboard.layouts.master')
@section('title', trans('addUser.User Management'))
@section('New User', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')

    @php
        $roles = \App\Models\Role::all();
    @endphp

    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addUser.User Management') }}</h4>
            <h6>{{ __('addUser.Add/Update User') }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form id="form" action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-sm-8 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.User Name') }}</label>
                                    <input type="text" name="name" id="name" maxlength="16">
                                    <p id="nameError"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.Mobile') }}</label>
                                    <input type="text" class="en" name="phoneNumber" id="phoneNumber"
                                        placeholder="0933123456" maxlength="16"
                                        oninput="this.value = this.value.replace(/[^0-9+-]/g, '').replace(/(\.*)\./g, '$1');" />
                                    <p id="phoneNumberError"></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.Email') }}</label>
                                    <input type="email" class="en" name="email" id="email">
                                    <p id="emailError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.Password') }}</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input" name="password" id="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <p id="passwordError"></p>

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.Confirm Password') }}</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs" name="Confirm_Password"
                                            id="Confirm_Password">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                    <p id="Confirm_PasswordError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('addUser.Role') }}</label>
                                    <select class="select" name="role_id" id="role_id">
                                        @foreach ($roles as $role)
                                            <option @if ($role->id == 3) selected @endif
                                                value="{{ $role->id }}">
                                                {{ __($role->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="role_idError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('addUser.Expiration Date') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="YYYY-MM-DD" id="expirationDate"
                                            name="expirationDate">
                                        <div class="addonset">
                                            <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}"
                                                alt="img">
                                        </div>
                                    </div>
                                    <p id="expirationDateError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('addUser.Gender') }}</label>
                                    <select class="select" name="gender" id="gender">
                                        <option value="Unspecified">{{ __('Unspecified') }}</option>
                                        <option value="Male">{{ __('Male') }}</option>
                                        <option value="Female">{{ __('Female') }}</option>
                                    </select>
                                    <p id="genderError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('addUser.Date Birth') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="1986-08-11" name="dateBirth" id="dateBirth">
                                        <div class="addonset">
                                            <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}"
                                                alt="img">
                                        </div>
                                    </div>
                                    <p id="dateBirthError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>{{ __('addUser.Status Message') }}</label>
                                <textarea class="form-control" name="status" id="status" maxlength="255"></textarea>
                                <p id="statusError"></p>
                            </div>
                        </div>


                        {{-- Image ROW --}}
                        <div class="form-group">
                            <label> {{ __('Upload Image') }}</label>
                            <div class="image-upload" id="profile">
                                <input type="file" name="profile"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="profileError"></p>
                        </div>


                    </div>


                    <!-- Note -->
                    <div class="col-12 col-sm-4  ">
                        <div class="note-group d-none d-sm-block ">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <ul>
                                    <li>{{ __('User Name') }}</li>
                                    <p>{{ __('Required field Maximum 255 characters') }}</p>
                                    <li>{{ __('Mobile') }}</li>
                                    <p>{{ __('Required, unique, allows the use of symbols + - and numbers 0-9 from 6 to 16. Example number 0933333333') }}
                                    </p>
                                    <li>{{ __('Email') }}</li>
                                    <p>{{ __('Required, unique, maximum 255 characters, example email@email.com') }}</p>
                                    <li>{{ __('Password') }}</li>
                                    <p>{{ __('Required, minimum 8 characters') }}</p>
                                    <li>{{ __('Confirm Password') }}</li>
                                    <p>{{ __('Required, matching password') }}</p>
                                    <li>{{ __('Role') }}</li>
                                    <p>{{ __('By default it is set as User') }}</p>
                                    <li>{{ __('Expiration Date') }}</li>
                                    <p>{{ __('Optional field') }}</p>
                                    <li>{{ __('Gender') }}</li>
                                    <p>{{ __('Gender is set to unspecified by default') }}</p>
                                    <li>{{ __('Date Birth') }}</li>
                                    <p>{{ __('Optional field') }}</p>
                                    <li>{{ __('Status Message') }}</li>
                                    <p>{{ __('Optional field') }}</p>
                                    <li>{{ __('Image') }}</li>
                                    <p>{{ __('Required field Required allowed extensions: JPEG, PNG, JPG, GIF, maximum size 5MB') }}
                                    </p>

                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Button ROW --}}
                    <div class="row">
                        <div class="col-sm-2 col">
                            <button id="submit" type="submit"
                                class="btn btn-submit w-100 ">{{ __('Create') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/assets/plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#expirationDate').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-0d',
                zIndexOffset: 99999999,
            });

            $('#dateBirth').datepicker({
                format: 'yyyy-mm-dd',
                zIndexOffset: 99999999,
                startDate: '-80y',
                endDate: '-10y'

            });





            $("#form").on("submit", function(event) {
                event.preventDefault();
                $('#submit').prop('disabled', true);
                var formData = new FormData(this); // Pass the HTML form element
                axios.post(this.action, formData)
                    .then(function(response) {
                        $('#submit').prop('disabled', false);
                        var message = response.data.message;

                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#form')[0].reset();
                    }).catch(function(error) {
                        $('#submit').prop('disabled', false);

                        var title = error.response.data.title
                        var message = error.response.data.message;
                        // Error message Test
                        console.log(error);
                        Swal.fire({
                            title: title,
                            text: message,
                            icon: "error",
                            confirmButtonText: "{{ __('swal_fire.Ok') }}",
                        });
                        if (title == 'error') {
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });
                        } else if (title.indexOf('images') !== -1) {
                            updateError('images', message);
                        } else {
                            updateError(title, message);
                        }


                    });
            });



            function updateError(elements, message) {
                const element = $('#' + elements);
                const error = $('#' + elements + 'Error');
                element.css('border', '1px solid #993333');
                error.css('color', 'brown');
                error.text(message);
                element.focus();
            }
        });
    </script>
@endsection
