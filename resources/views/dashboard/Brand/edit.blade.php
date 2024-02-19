@extends('dashboard.layouts.master')
@section('title', trans('add_edit.Edit Brand'))
@section('Add Brand', 'active')
@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('add_edit.Edit Product Brand') }}</h4>
            <h6>{{ __('add_edit.Edit a product Brand') }} {{ __($value->name) }}</h6>
        </div>
    </div>

    <!-- Page Card -->
    <div class="card">
        <div class="card-body">
            <form id="form" action="{{ route('/updateBrand') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-8">

                        <!-- Name -->
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $value->name) }}">
                            <p class="error" id="nameError"></p>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label>{{ __('Description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $value->description) }}</textarea>
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

                    <!-- Image -->
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <div id="Images"></div>
                        </div>
                    </div>

                    <!-- button -->
                    <div class="col-12 col-sm-8">
                        <button type="Submit" href="javascript:void(0);"
                            class="btn btn-submit me-2">{{ __('Update') }}</button>
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


            getImages();

            function getImages() {
                axios.post('{{ route('getBrandImages') }}', {
                    "_token": '{{ csrf_token() }}',
                    "id": '{{ $value->id }}'
                }).then(function(response) {
                    $('#Images').html(response.data);
                    $(".delete").on('click', function(event) {
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
                        axios.post('{{ route('deleteBrandImage') }}', {
                            "_token": '{{ csrf_token() }}',
                            "id": id
                        }).then(function(response) {
                            getImages();
                            var message = response.data.message;
                            Swal.fire({
                                icon: "success",
                                title: message,
                                showConfirmButton: false,
                                timer: 1500
                            });

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
                var formData = new FormData(this);
                formData.append('id', {{ $value->id }});
                axios.post(this.action, formData)
                    .then(function(response) {
                        var message = response.data.message;
                        Swal.fire({
                            icon: "success",
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        getImages();

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
