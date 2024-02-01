@extends('dashboard.layouts.master')
@section('title', trans('addBrand.Product Add Brand'))
@section('Product', 'active')
@section('addBrand', 'active')
@section('head')

@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addBrand.Product Add Brand') }}</h4>
            <h6>{{ __('addBrand.Create new product Brand') }}</h6>
        </div>
    </div>


    <form id="form" action="{{ route('Brand.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">




                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addBrand.Brand Name') }}</label>
                            <input type="text" name="name" id="name">
                            <p id="nameError"></p>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addBrand.Description') }}</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            <p id="descriptionError"></p>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addBrand.Brand Image') }}</label>
                            <div class="image-upload" id="image">
                                <input type="file" name="image"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads flex flex-col items-center">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('addBrand.Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="imageError"></p>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <button id="submit" type="submit"
                            class="btn btn-submit me-2 bg-[#ff9f43]">{{ __('addBrand.Submit') }}</button>
                        {{-- <button href="productlist.html" class="btn btn-cancel">{{ __('addBrand.Cancel') }}</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </form>


@endsection
@section('script')

    <script>
        $(document).ready(function() {


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

                        // For Test Errors
                        // Swal.fire({
                        //     title: "{{ __('swal_fire.Error') }}",
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
