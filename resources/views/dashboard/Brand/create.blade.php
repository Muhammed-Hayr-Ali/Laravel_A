@extends('dashboard.layouts.master')
@section('title', trans('add_edit.Add Brand'))
@section('Add Brand', 'active')
@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('add_edit.Product Add Brand') }}</h4>
            <h6>{{ __('add_edit.Create new product Brand') }}</h6>
        </div>
    </div>

    <!-- Page Card -->
    <div class="card">
        <div class="card-body">
            <form id="form" action="{{ route('Brand.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-8">

                        <!-- Name -->
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" id="name">
                            <p class="error" id="nameError"></p>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label>{{ __('Description') }}</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            <p class="error" id="descriptionError"></p>
                        </div>

                        <!-- Upload Image -->
                        <div class="form-group">
                            <label>{{ __('Upload Image') }}</label>
                            <div class="image-upload" id="image">
                                <input type="file" name="image"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p class="error" id="imageError"></p>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-12 col-sm-4">
                        <div class="note-group d-none d-sm-block ">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <ul>
                                    <li>{{ __('Name') }}</li>
                                    <p>{{ __('Required field Maximum 255 characters') }}</p>
                                    <li>{{ __('Description') }}</li>
                                    <p>{{ __('Required field Maximum 255 characters') }}</p>
                                    <li>{{ __('Image') }}</li>
                                    <p>{{ __('Required field Required allowed extensions: JPEG, PNG, JPG, GIF, maximum size 5MB') }}
                                    </p>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- button -->
                    <div class="col-12 col-sm-8">
                        <button type="Submit" href="javascript:void(0);"
                            class="btn btn-submit me-2">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<!--script-->
@section('script')
    <script>
        $(document).ready(function() {

            $("#form").on("submit", function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                axios.post(this.action, formData)
                    .then(function(response) {
                        var message = response.data.message;
                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#form')[0].reset();

                    }).catch(function(error) {

                        var title = error.response.data.title
                        var message = error.response.data.message;

                        if (title == 'error') {
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });

                        } else {
                            updateError(title, message);
                        }
                    });
            });

            function updateError(elements, message) {
                const element = $('#' + elements);
                const error = $('#' + elements + 'Error');
                element.css('border', '1px solid #993333');
                error.text(message);
                element.focus();
            }
        });
    </script>
@endsection
