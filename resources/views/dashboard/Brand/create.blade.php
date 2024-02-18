@extends('dashboard.layouts.master')
@section('title', trans('addBrand.Product Add Brand'))
@section('Add Brand', 'active')
@section('content')

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addBrand.Product Add Brand') }}</h4>
            <h6>{{ __('addBrand.Create new product Brand') }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form id="form" action="{{ route('Brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- General Row --}}
                <div class="row">
                    {{-- NAME Col --}}
                    <div class="col-sm-8 col-12 ">
                        {{-- NAME ROW --}}
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name">
                                    <p id="nameError"></p>
                                </div>
                            </div>
                        </div>
                        {{-- Description ROW --}}
                        <div class="form-group">
                            <label>{{ __('Description') }}</label>
                            <textarea class="form-control" name="description" id="description" maxlength="255"></textarea>
                            <p id="descriptionError"></p>
                        </div>
                    </div>
                    {{-- view Image --}}
                    <div class="col-12 col-sm-4">
                        {{-- Image ROW --}}
                        <div class="form-group">
                            <label> {{ __('Image') }}</label>
                            <div class="image-upload" id="image">
                                <input type="file" name="image"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="imageError"></p>
                        </div>

                    </div>
                </div>
                {{-- Button ROW --}}
                <div class="row">
                    <div class="col-sm-2 col">
                        <button id="submit" type="submit" class="btn btn-submit w-100 ">{{ __('Create') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {





            $("#form").on("submit", function(event) {
                event.preventDefault();
                $('#submit').prop('disabled', true);
                var formData = new FormData(this);
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
