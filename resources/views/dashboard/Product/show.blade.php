@extends('dashboard.layouts.master')
@section('title', trans('product_details.Product Details'))
@section('Products List', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.css') }}">
@endsection
@section('content')


    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('product_details.Product Details') }}</h4>
            <h6>{{ __('product_details.Full details of a product') }}</h6>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-8 col-12">
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
                                data-name="{{ $product->productName }}"
                                data-short="{{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}">
                                <img src="{{ asset('dashboard/assets/img/icons/delete.svg') }}" alt="img">
                            </a>
                        </div>

                    </div>
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>{{ __('product_details.Product') }}</h4>
                                <h6>{{ $product->productName }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Category') }}</h4>
                                <h6>{{ __($product->category->name) }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Level') }}</h4>
                                <h6>{{ __($product->level->name) }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Unit') }}</h4>
                                <h6>{{ __($product->unit->name) }} {{ $product->quantity }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Code') }}</h4>
                                <h6>{{ $product->code }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Qty') }}</h4>
                                <h6>{{ $product->availableQuantity }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Minimum Qty') }}</h4>
                                <h6>{{ $product->minimumQuantity }}</h6>
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
                                <h4>{{ __('product_details.Discount') }}</h4>
                                <h6>{{ $product->discount }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Price') }}</h4>
                                <h6>{{ $product->price }}</h6>
                            </li>
                            <li>
                                <h4>{{ __('product_details.Status') }}</h4>
                                <h6>{{ __($product->status->name) }}</h6>
                            </li>



                        </ul>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-sm-4 col-12">
            <div class="card">
                <div class="card-body">

                    @if (isset($product->thumbnailImage))
                        <label> {{ __('addProduct.Thumbnail Image') }}</label>
                        <a href="{{ asset($product->thumbnailImage) }}" class="image-popup" data-lightbox="roadtrip">
                            <img class="rounded-1 " src="{{ asset($product->thumbnailImage) }}" alt="img">
                        </a>
                    @endif


                    @if (isset($product->images) && count($product->images) > 0)
                        <label> {{ __('addProduct.Product Images') }}</label>
                        <div class="slider-product-details">
                            <div class="owl-carousel owl-theme product-slide owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 622px;">



                                        @foreach ($product->images as $image)
                                            <div class="owl-item active" style="width: 280px;">
                                                <div class="slider-product pb-2">

                                                    <a href="{{ asset($image->url) }}" class="image-popup"
                                                        data-lightbox="roadtrip">
                                                        <img class="rounded-1 " src="{{ asset($image->url) }}"
                                                            alt="img">
                                                    </a>

                                                    <h4>{{ basename($image->name) }}</h4>
                                                </div>
                                            </div>
                                        @endforeach




                                    </div>
                                </div>
                                <div class="owl-nav"><button type="button" role="presentation"
                                        class="owl-prev disabled"><span aria-label="Previous">‹</span></button><button
                                        type="button" role="presentation" class="owl-next"><span
                                            aria-label="Next">›</span></button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>



@endsection


@section('script')

    <script src="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>


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
