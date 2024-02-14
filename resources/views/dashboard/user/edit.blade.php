@extends('dashboard.layouts.master')
@section('title', trans('addUser.User Management'))
@section('New User', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addUser.User Management') }}</h4>
            <h6>{{ __('addUser.Add/Update User') }}</h6>
        </div>
    </div>

    <form id="form" action="{{ route('/updateUser') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.User Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}">
                                    <p id="nameError"></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>{{ __('addUser.Mobile') }}</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber"
                                        value="{{ old('phoneNumber', $user->phoneNumber) }}">
                                    <p id="phoneNumberError"></p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>{{ __('addUser.User email') }}</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ old('email', $user->email) }}" disabled>
                                        <p id="emailError"></p>
                                    </div>
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
                                        <input type="password" class=" pass-inputs" name="Confirm_Password"
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
                                            <option @if ($user->role_id == $role->id) selected @endif
                                                value="{{ $role->id }}">{{ __($role->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="role_idError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('addUser.Expiration Date') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="Y-m-d" id="expirationDate" name="expirationDate"
                                            @if (isset($user->expirationDate) && $user->expirationDate != null) value="{{ old('expirationDate', Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->expirationDate)->format('Y-m-d')) }}" @endif>
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
                                        <option @if ($user->gender == 'Unspecified') selected @endif value="Unspecified">
                                            {{ __('Unspecified') }}</option>
                                        <option @if ($user->gender == 'Male') selected @endif value="Male">
                                            {{ __('Male') }}</option>
                                        <option @if ($user->gender == 'Female') selected @endif value="Female">
                                            {{ __('Female') }}</option>
                                    </select>
                                    <p id="genderError"></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                {{-- <div class="form-group">
                                    <label>{{ __('addUser.Date Birth') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="YYYY-MM-DD" name="dateBirth" id="dateBirth">
                                        <div class="addonset">
                                            <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}"
                                                alt="img">
                                        </div>
                                    </div>
                                    <p id="dateBirthError"></p>
                                </div> --}}


                                <div class="form-group">
                                    <label>{{ __('addUser.Date Birth') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="Y-m-d" id="dateBirth" name="dateBirth"
                                            @if (isset($user->dateBirth) && $user->dateBirth != null) value="{{ old('dateBirth', Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->dateBirth)->format('Y-m-d')) }}" @endif>
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
                            <div class="form-group">
                                <label>{{ __('addUser.Status Message') }}</label>
                                <textarea class="form-control" name="status" id="status" maxlength="255">{{ old('expirationDate', $user->status) }}</textarea>
                                <p id="statusError"></p>
                            </div>
                        </div>




                        <div class="col-lg-12">
                            <button id="submit" type="submit"
                                class="btn btn-submit me-2 bg-[#ff9f43]">{{ __('Submit') }}</button>
                            {{-- <button href="productlist.html" class="btn btn-cancel">{{ __('addLevel.Cancel') }}</button> --}}
                        </div>

                    </div>

                    {{-- view Image --}}
                    <div class="col-lg-4 col-sm-4 col-12 mt-lg-0 mt-5">
                        {{-- Image ROW --}}
                        <div class="form-group">
                            <div class="form-group">
                                <label> {{ __('Image') }}</label>
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
                        <div id="Images"></div>
                    </div>



                </div>
            </div>
        </div>
    </form>

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



            getImages();

            function getImages() {
                axios.post('{{ route('getUserImages') }}', {
                    "_token": '{{ csrf_token() }}',
                    "id": '{{ $user->id }}'
                }).then(function(response) {
                    $('#Images').html(response.data); // الصفحة التي تحوي الزر

                    $(".delete").on('click', function(event) { // الوظيفة التي يقوم بها الزر
                        event.preventDefault();
                        var id = $(this).data("id");
                        var name = $(this).data("name");
                        deleteImage(id, name);
                    });
                }).catch(function(error) {
                    console.log(error);
                });
            }

            function deleteImage(id, name) {
                Swal.fire({
                    title: "{{ __('swal_fire.Delete') }}",
                    html: `{{ __('swal_fire.Are you sure you want to delete the image :value?', ['value' => '  ${name}  ']) }}`,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('swal_fire.Delete') }}",
                    cancelButtonText: "{{ __('swal_fire.Cancel') }}",
                    confirmButtonColor: "#dc3545"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('{{ route('deleteUserImage') }}', {
                            "_token": '{{ csrf_token() }}',
                            "id": id
                        }).then(function(response) {
                            var message = response.data.message;
                            Swal.fire({
                                icon: "success",
                                title: message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            getImages();
                        }).catch(function(error) {
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: error.message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });
                        });
                    }
                });
            }



            $("#form").on("submit", function(event) {
                event.preventDefault();
                $('#submit').prop('disabled', true);
                var formData = new FormData(this);
                formData.append('id', {{ $user->id }});
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

                        getImages();
                    }).catch(function(error) {
                        $('#submit').prop('disabled', false);

                        var title = error.response.data.title
                        var message = error.response.data.message;

                        // Swal.fire({
                        //     title: title,
                        //     text: message,
                        //     icon: "error",
                        //     confirmButtonText: "{{ __('swal_fire.Ok') }}",
                        // });

                        if (title == 'error') {
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });
                        } else if (title.indexOf('profile') !== -1) {
                            updateError('profile', message);
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
