@extends('dashboard.layouts.master')
@section('title', trans('addLevel.Edit Product Level'))
@section('Product', 'active')
@section('addLevel', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.css') }}">

@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addLevel.Edit Product Level') }}</h4>
            <h6>{{ __('addLevel.Edit a product Level') }}</h6>
        </div>
    </div>

    <form id="form" action="{{ route('/updateLevel') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addLevel.Level Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $level->name) }}">
                            <p id="nameError"></p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addLevel.Description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $level->description) }}"</textarea>
                            <p id="descriptionError"></p>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addLevel.Level Image') }}</label>
                            <div class="image-upload" id="image">
                                <input type="file" name="image"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads flex flex-col items-center">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('addLevel.Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="imageError"></p>
                        </div>
                    </div>



                    {{--
                    @if (isset($product->images) && count($product->images) > 0)
                        <div class="col-12">
                            <div class="product-list">
                                <ul class="row">


                                    @foreach ($product->images as $key => $image)
                                        <li>
                                            <div id="{{ $image->id }}" class="productviews">
                                                <div class="productviewsimg">
                                                    <img src="{{ asset($image->url) }}" alt="img">
                                                </div>
                                                <div class="productviewscontent">
                                                    <div class="productviewsname">
                                                        <h2>{{ $image->name }}</h2>
                                                    </div>
                                                    <a data-name="{{ $image->name }}"
                                                        data-id="{{ $image->id }}">x</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endif
 --}}

                    <div id="Images" class="w-full"></div>

                    <div class="col-lg-12">
                        <button id="submit" type="submit"
                            class="btn btn-submit me-2 bg-[#ff9f43]">{{ __('addLevel.Update') }}</button>
                        {{-- <button href="productlist.html" class="btn btn-cancel">{{ __('addLevel.Cancel') }}</button> --}}
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


            $('#expiration_date').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-0d',
                zIndexOffset: 99999999,
            });


            getImages();

            function getImages() {
                axios.post('{{ route('getLevelImages') }}', {
                    "_token": '{{ csrf_token() }}',
                    "id": '{{ $level->id }}'
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
                    html: `{{ __('swal_fire.Are you sure you want to delete the image?') }} <br><br><b>${name}</b>`,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('swal_fire.Delete') }}",
                    cancelButtonText: "{{ __('swal_fire.Cancel') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('{{ route('deleteLevelImage') }}', {
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
                formData.append('id', {{ $level->id }});
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
                        // for Test
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
