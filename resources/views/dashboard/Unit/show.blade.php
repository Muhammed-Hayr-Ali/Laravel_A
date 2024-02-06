@extends('dashboard.layouts.master')
@section('title', trans('product_details.Product Details'))
@section('Category List', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owlcarousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.css') }}">

@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('product_details.Product Details') }}</h4>
            <h6>{{ __('product_details.Full details of a product') }}</h6>
        </div>
    </div>





    <div class="row">
        @if (isset($product->images) && count($product->images) > 0)
            <div class="col-lg-8 col-sm-12">
            @else
                <div class="col-lg-12 col-sm-12">
        @endif

        <div class="card">
            <div class="card-body">
                <div class="bar-code-view">
                    {{ $qrcode }}



                    <div class="row px-2">
                        <a class="col-auto p-0 " id="print"
                            data-url="{{ route('printProduct', ['id' => $product->id]) }}" class="printimg">
                            <img src="{{ asset('dashboard/assets/img/icons/printer.svg') }}" alt="print">
                        </a>

                        <a class="col-auto px-3 " href="{{ route('Product.edit', ['Product' => $product->id]) }}">
                            <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}" alt="img">
                        </a>


                        <a class="col-auto p-0 deleteButton"
                            data-url="{{ route('Product.destroy', ['Product' => $product->id]) }}"
                            data-name="{{ $product->name }}"
                            data-short="{{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}">
                            <img src="{{ asset('dashboard/assets/img/icons/delete.svg') }}" alt="img">
                        </a>
                    </div>

                </div>
                <div class="productdetails">
                    <ul class="product-bar">
                        <li>
                            <h4>{{ __('product_details.Product') }}</h4>
                            <h6>{{ $product->name }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Category') }}</h4>
                            <h6>{{ $product->category->name }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Unit') }}</h4>
                            <h6>{{ $product->unit->name }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Brand') }}</h4>
                            <h6>{{ $product->brand->name }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Unit') }}</h4>
                            <h6>{{ $product->unit->name }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Code') }}</h4>
                            <h6>{{ $product->code }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Minimum Qty') }}</h4>
                            <h6>{{ $product->minimum_Qty }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Qty') }}</h4>
                            <h6>{{ $product->quantity }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Expiration Date') }}
                            </h4>
                            <h6>{{ date('Y-m-d', strtotime($product->expiration_date)) }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Description') }}</h4>
                            <h6>{{ $product->description }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Tax') }}</h4>
                            <h6>{{ $product->tax }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Discount') }}</h4>
                            <h6>{{ $product->discount }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Price') }}</h4>
                            <h6>{{ $product->price }}</h6>
                        </li>
                        <li>
                            <h4>{{ __('product_details.Status') }}</h4>
                            <h6>{{ $product->status->name }}</h6>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
    </div>


    @if (isset($product->images) && count($product->images) > 0)
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="slider-product-details">
                        <div class=" owl-rtl owl-carousel owl-theme product-slide">


                            @foreach ($product->images as $image)
                                <div class="slider-product">
                                    <a href="{{ asset($image->url) }}" class="image-popup" data-lightbox="roadtrip">
                                        <img class="" src="{{ asset($image->url) }}" alt="img">
                                    </a>
                                    <h4>{{ $image->name }}</h4>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif


    </div>

@endsection
@section('script')


@section('script')
    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                error();

                function error() {
                    Swal.fire({
                        title: "{{ __('swal_fire.Error') }}",
                        text: "{{ Session::get('error') }}",
                        icon: "error",
                        confirmButtonText: "{{ __('swal_fire.Ok') }}",
                    });
                }

            });
        </script>
    @endif









    <script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>

    <script src="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Print Ok!!
            $("#print").click(function() {
                var url = $(this).data('url');
                axios.get(url, {
                    "_token": '{{ csrf_token() }}',
                }).then(function(response) {
                    var iframe = document.createElement('iframe');
                    iframe.style.display = 'none';
                    document.body.appendChild(iframe);
                    var iframeDoc = iframe.contentWindow.document;
                    iframeDoc.open();
                    iframeDoc.write(response.data);
                    iframeDoc.close();
                    iframe.contentWindow.print();
                }).catch(function(error) {
                    var title = error.response.data.title;
                    var message = error.response.data.message;
                    Swal.fire({
                        title: "{{ __('swal_fire.Error') }}",
                        text: message,
                        icon: "error",
                        confirmButtonText: "{{ __('swal_fire.Ok') }}",

                    });
                });

            });



            // Delete OK !!
            $('.deleteButton').on('click', function() {
                var url = $(this).data('url');
                var name = $(this).data('name');

                Swal.fire({
                    title: "{{ __('swal_fire.Delete') }}",
                    html: `{{ __('swal_fire.Are you sure you want to delete :value and the images associated with it?', ['value' => '  ${name}  ']) }}`,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('swal_fire.Delete') }}",
                    cancelButtonText: "{{ __('swal_fire.Cancel') }}",
                    confirmButtonColor: "#dc3545"

                }).then((result) => {


                    if (result.isConfirmed) {
                        axios.delete(url, {
                            "_token": '{{ csrf_token() }}',
                        }).then(function(response) {
                            var message = response.data.message;
                            Swal.fire({
                                icon: "success",
                                title: message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(redirectUser, 1500);

                            function redirectUser() {
                                window.location.href = "{{ route('Product.index') }}";
                            }


                        }).catch(function(error) {
                            var message = error.response.data.message;
                            Swal.fire({
                                title: "{{ __('swal_fire.Error') }}",
                                text: message,
                                icon: "error",
                                confirmButtonText: "{{ __('swal_fire.Ok') }}",
                            });
                        });
                    }

                });

            });



        });
    </script>
@endsection
