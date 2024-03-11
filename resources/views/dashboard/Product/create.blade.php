@extends('dashboard.layouts.master')
@section('title', trans('addProduct.Product Add'))
@section('Add Product', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addProduct.Product Add') }}</h4>
            <h6>{{ __('addProduct.Create new product') }}</h6>
        </div>
    </div>


    <form id="form" action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-8">
                        {{-- Product Name --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Product Name') }}</label>
                            <input type="text" name="productName" id="productName">
                            <p id="productNameError"></p>
                        </div>

                        {{-- Code --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Code') }}</label>
                            <input type="text" name="code" id="code">
                            <p id="codeError"></p>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>{{ __('addProduct.Description') }}</label>
                            <textarea class="form-control" name="description" id="description" maxlength="255"></textarea>
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
                                            <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                                        @endforeach

                                    </select>
                                    <p id="category_idError"></p>
                                </div>
                            </div>



                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Level') }}</label>
                                    <select class="select" name="level_id" id="level_id">
                                        <option>{{ __('addProduct.Choose Level') }}</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ __($level->name) }}</option>
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
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    <p id="priceError"></p>
                                </div>
                            </div>


                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Discount') }}</label>
                                    <input type="text" name="discount" id="discount"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
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
                                            <option value="{{ $unit->id }}">{{ __($unit->name) }}</option>
                                        @endforeach
                                    </select>
                                    <p id="unit_idError"></p>
                                </div>
                            </div>


                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Quantity') }}</label>
                                    <input type="text" name="quantity" id="quantity"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
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
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    <p id="availableQuantityError"></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('addProduct.Minimum Quantity') }}</label>
                                    <input type="text" name="minimumQuantity" id="minimumQuantity"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
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
                                            <option value="{{ $status->id }}">{{ __($status->name) }}</option>
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
                                            name="expiration_date">
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





                {{-- Button ROW --}}
                <div class="row">
                    <div class="col-sm-2 col">
                        <button id="submit" type="submit" class="btn btn-submit w-100 ">{{ __('Create') }}</button>
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
