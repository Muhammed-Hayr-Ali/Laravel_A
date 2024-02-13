@php
    $currentLocale = app()->getLocale();
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('auth/css/bootstrap.min.css') }}" rel="stylesheet">
    @if ($currentLocale == 'ar')
        <link rel="stylesheet" href="{{ asset('auth/css/rtl_style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
    @endif


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>




    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="container p-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 rounded-3 border-danger bg-white px-3 py-5 shadow-sm ">

                    <form id="form" action="{{ route('signin.store') }}" method="POST">
                        @csrf

                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ __(Session::get('error')) }}
                            </div>
                        @endif






                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="text" name="email" class="form-control shadow-none"
                                placeholder="email@email.com" value="{{ old('email') }}" />
                        </div>




                        <div class="mb-3 pb-3 ">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-control shadow-none"
                                    placeholder="password" value="{{ old('password') }}" />
                                <a id='showPass' href="#">
                                    <i class="fa fa-eye" aria-hidden="false"></i>
                                </a>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button id="submit" type="submit" class="btn primary "
                                type="button">{{ __('sign in') }}</button>
                        </div>


                    </form>


                </div>


            </div>

        </div>

    </div>









    <script src="{{ asset('auth/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('auth/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('dashboard/assets/js/axios.1.6.5.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#showPass').click(function(event) {
                event.preventDefault();
                $("#showPass i").toggleClass("fa-eye fa-eye-slash");
                var passwordField = $('#password');
                var currentType = passwordField.attr('type');
                var newType = (currentType === 'password') ? 'text' : 'password';
                passwordField.attr('type', newType);

            });


            // $("#form").on("submit", function(event) {
            //     event.preventDefault();
            //     var formData = new FormData(this); // Pass the HTML form element
            //     axios.post(this.action, formData)
            //         .then(function(response) {

            //             var message = response.data.message;
            //             var title = response.data.title
            //             var message = response.data.message;

            //             alert(message);


            //             $('#form')[0].reset();
            //         }).catch(function(error) {
            //             $('#submit').prop('disabled', false);

            //             var title = error.response.data.title
            //             var message = error.response.data.message;

            //             alert(message);
            //             //  updateError(title, message);



            //         });
            // });



            // function updateError(elements, message) {
            //     const element = $('#' + elements);
            //     const error = $('#' + elements + 'Error');
            //     element.css('border', '1px solid #993333');
            //     error.css('color', 'brown');
            //     error.text(message);
            //     element.focus();
            // }


        });
    </script>
</body>

</html>
