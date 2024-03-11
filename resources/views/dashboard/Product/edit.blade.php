@extends('dashboard.layouts.master')
@section('title', trans('addProduct.Product Edit'))
@section('Add Product', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addProduct.Product Edit') }}</h4>
            <h6>{{ __('addProduct.Update your product') }}</h6>
        </div>
    </div>

    <form id="form" action="{{ route('/update') }}" method="POST" enctype="multipart/form-data">

        @csrf




        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-8">
                        {{-- Product Name --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Product Name') }}</label>
                            <input type="text" name="productName" id="productName"
                                @if ($product->productName != null) value="{{ old('productName', $product->productName) }}" @endif>
                            <p id="productNameError"></p>
                        </div>

                        {{-- Code --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Code') }}</label>
                            <input type="text" name="code" id="code"
                                @if ($product->code != null) value="{{ old('code', $product->code) }}" @endif>
                            <p id="codeError"></p>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Description') }}</label>
                            <textarea class="form-control" name="description" id="description" maxlength="255"> @if ($product->description != null)
{{ old('description', $product->description) }}
@endif
</textarea>
                            <p id="descriptionError"></p>
                        </div>


                        {{-- Category and Level --}}
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Category') }}</label>
                                    <select class="select" name="category_id" id="category_id">
                                        <option>{{ __('addProduct.Choose Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option @if ($product->category_id != null && $product->category_id == $category->id) selected @endif
                                                value="{{ $category->id }}">{{ __($category->name) }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <p id="category_idError"></p>


                                </div>
                            </div>



                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Choose Level') }}</label>
                                    <select class="select" name="level_id" id="level_id">
                                        <option>{{ __('addProduct.Choose Level') }}</option>
                                        @foreach ($levels as $level)
                                            <option @if ($product->level_id != null && $product->level_id == $level->id) selected @endif
                                                value="{{ $level->id }}">{{ __($level->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="level_idError"></p>

                                </div>
                            </div>


                        </div>


                        {{-- price && Discount --}}
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Price') }}</label>
                                    <input type="text" name="price" id="price"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        @if ($product->price != null) value="{{ old('price', $product->price) }}" @endif />
                                    <p id="priceError"></p>
                                </div>
                            </div>


                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Discount') }}</label>
                                    <input type="text" name="discount" id="discount"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        @if ($product->discount != null) value="{{ old('discount', $product->discount) }}" @endif />
                                    <p id="discountError"></p>
                                </div>
                            </div>
                        </div>



                        {{-- Unit and Qty --}}
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Unit') }}</label>
                                    <select class="select" name="unit_id" id="unit_id">
                                        <option>{{ __('addProduct.Choose Unit') }}</option>
                                        @foreach ($units as $unit)
                                            <option @if ($product->unit_id != null && $product->unit_id == $unit->id) selected @endif
                                                value="{{ $unit->id }}">{{ __($unit->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="unit_idError"></p>
                                </div>
                            </div>


                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Quantity') }}</label>
                                    <input type="text" name="quantity" id="quantity"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        @if ($product->quantity != null) value="{{ old('quantity', $product->quantity) }}" @endif />
                                    <p id="quantityError"></p>
                                </div>
                            </div>

                        </div>



                        {{-- availableQuantity && minimumQuantity --}}
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Available Quantity') }}</label>
                                    <input type="text" name="availableQuantity" id="availableQuantity"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        @if ($product->availableQuantity != null) value="{{ old('availableQuantity', $product->availableQuantity) }}" @endif />
                                    <p id="availableQuantityError"></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Minimum Quantity') }}</label>
                                    <input type="text" name="minimumQuantity" id="minimumQuantity"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        @if ($product->minimumQuantity != null) value="{{ old('minimumQuantity', $product->minimumQuantity) }}" @endif />
                                    <p id="minimumQuantityError"></p>
                                </div>
                            </div>

                        </div>



                        {{-- Status && Expiration --}}
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Status') }}</label>
                                    <select class="select" name="status_id" id="status_id">
                                        <option>{{ __('addProduct.Choose Status') }}</option>
                                        @foreach ($statuses as $status)
                                            <option @if ($product->status_id != null && $product->status_id == $status->id) selected @endif
                                                value="{{ $status->id }}">{{ __($status->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="status_idError"></p>
                                </div>
                            </div>


                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Expiration Date') }}</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="YYYY-MM-DD" id="expiration_date"
                                            name="expiration_date"
                                            @if ($product->expiration_date != null) value="{{ old('expiration_date', Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->expiration_date)->format('Y-m-d')) }}" @endif>
                                        <div class="addonset">
                                            <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}"
                                                alt="img">
                                        </div>
                                        <p id="expiration_dateError"></p>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label> {{ __('addProduct.Thumbnail Image') }}</label>
                            <div class="image-upload" id="thumbnailImage">
                                <input type="file" name="thumbnailImage"accept=".jpg, .jpeg, .png">
                                <div class="image-uploads">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="thumbnailImageError"></p>
                        </div>


                        <div class="form-group">
                            <label> {{ __('addProduct.Product Images') }}</label>
                            <div class="image-upload" id="images">
                                <input type="file" name="images[]"accept=".jpg, .jpeg, .png" multiple>
                                <div class="image-uploads">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                            <p id="imagesError"></p>
                        </div>


                    </div>
                </div>



                {{-- Old Image --}}
                <div class="form-group">
                    <div id="Images"></div>
                </div>

                {{-- Button ROW --}}
                <div class="row">
                    <div class="col-sm-2 col">
                        <button id="submit" type="submit" class="btn btn-submit w-100 ">{{ __('Update') }}</button>
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
                axios.post('{{ route('getImages') }}', {
                    "_token": '{{ csrf_token() }}',
                    "id": '{{ $product->id }}'
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
                        axios.post('{{ route('deleteImages') }}', {
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
                formData.append('id', {{ $product->id }});
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
