@extends('dashboard.layouts.master')
@section('title', trans('addUnit.Edit a product Unit'))
@section('Add Unit', 'active')
@section('head')
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addUnit.Edit Product Unit') }}</h4>
            <h6>{{ __('addUnit.Edit a product Unit') }}</h6>
        </div>
    </div>

    <form id="form" action="{{ route('/updateUnit') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addUnit.Unit Image') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $unit->name) }}">
                            <p id="nameError"></p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addUnit.Description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $unit->description) }}"</textarea>
                            <p id="descriptionError"></p>
                        </div>
                    </div>




                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addUnit.Unit Image') }}</label>
                            <div class="image-upload" id="image">
                                <input type="file" name="image"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads flex flex-col items-center">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('addUnit.Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="imageError"></p>
                        </div>
                    </div>





                    <div id="Images" class="w-full"></div>

                    <div class="col-lg-12">
                        <button id="submit" type="submit"
                            class="btn btn-submit me-2 bg-[#ff9f43]">{{ __('addUnit.Update') }}</button>
                        {{-- <button href="productlist.html" class="btn btn-cancel">{{ __('addUnit.Cancel') }}</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </form>


@endsection
@section('script')


    <script>
        $(document).ready(function() {

            getImages();

            function getImages() {
                axios.post('{{ route('getUnitImages') }}', {
                    "_token": '{{ csrf_token() }}',
                    "id": '{{ $unit->id }}'
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
                        axios.post('{{ route('deleteUnitImage') }}', {
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
                formData.append('id', {{ $unit->id }});
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
                element.css('border', '1px solid #dc3545');
                error.css('color', 'brown');
                error.text(message);
                element.focus();
            }













        });
    </script>
@endsection
