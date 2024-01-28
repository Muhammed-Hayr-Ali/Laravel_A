@extends('dashboard.layouts.master')
@section('title', trans('addproduct.Add Product'))
@section('Product', 'active')
@section('addproduct', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('addproduct.Product Add') }}</h4>
            <h6>{{ __('addproduct.Create new product') }}</h6>
        </div>
    </div>


    <form id="form" action="{{ route('newProduct') }}" method="POST">

        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">




                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Product Name') }}</label>
                            <input type="text" name="name" id="name">
                            <p id="nameError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Category') }}</label>
                            <select class="select" name="category_id" id="category_id">
                                <option>{{ __('addproduct.Choose Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ __('category.' . $category->name) }}</option>
                                @endforeach

                            </select>
                            <p id="category_idError"></p>


                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Choose Level') }}</label>
                            <select class="select" name="level_id" id="level_id">
                                <option>{{ __('addproduct.Choose Level') }}</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ __('levels.' . $level->name) }}</option>
                                @endforeach
                            </select>
                            <p id="level_idError"></p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Brand') }}</label>
                            <select class="select" name="brand_id" id="brand_id">
                                <option value="1">{{ __('addproduct.Choose Brand') }}</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <p id="brand_idError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Unit') }}</label>
                            <select class="select" name="unit_id" id="unit_id">
                                <option>{{ __('addproduct.Choose Unit') }}</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ __('unit.' . $unit->name) }}</option>
                                @endforeach
                            </select>
                            <p id="unit_idError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Code') }}</label>
                            <input type="text" name="code" id="code">
                            <p id="codeError"></p>
                        </div>

                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Minimum Qty') }}</label>
                            <input type="text" name="minimum_Qty" id="minimum_Qty"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <p id="minimum_QtyError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Quantity') }}</label>
                            <input type="text" name="quantity" id="quantity"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <p id="quantityError"></p>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="form-group">
                            <label>{{ __('addproduct.Expiration Date') }}</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="YYYY-MM-DD" id="expiration_date">
                                <div class="addonset">
                                    <img src="{{ asset('dashboard/assets/img/icons/calendars.svg') }}" alt="img">
                                </div>
                                <p id="expiration_dateError"></p>

                            </div>
                        </div>

                    </div>




                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Description') }}</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                            <p id="descriptionError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Tax') }}</label>
                            <input type="text" name="tax" id="tax"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <p id="taxError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Discount') }}</label>
                            <input type="text" name="discount" id="discount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <p id="discountError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Price') }}</label>
                            <input type="text" name="price" id="price"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            <p id="priceError"></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Status') }}</label>
                            <select class="select" name="status_id" id="status_id">
                                <option>{{ __('addproduct.Choose Status') }}</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ __('status.' . $status->name) }}</option>
                                @endforeach
                            </select>
                            <p id="status_idError"></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ __('addproduct.Product Image') }}</label>
                            <div class="image-upload">
                                <input type="file" name="images[]" multiple>
                                <div class="image-uploads flex flex-col items-center">
                                    <img src="{{ asset('dashboard/assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>{{ __('addproduct.Drag and drop a file to upload') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit"
                            class="btn btn-submit me-2 bg-[#ff9f43]">{{ __('addproduct.Submit') }}</button>
                        {{-- <button href="productlist.html" class="btn btn-cancel">{{ __('addproduct.Cancel') }}</button> --}}
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


                var formData = new FormData(this); // Pass the HTML form element
                axios.post(form.action, formData)
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
                                icon: "error",
                                title: message,
                                showConfirmButton: false,
                                timer: 2500
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
