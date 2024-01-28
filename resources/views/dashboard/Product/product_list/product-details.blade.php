@extends('dashboard.layouts.master')
@section('title', trans('productlist.Product Details'))
@section('Product', 'active')
@section('productlist', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.css') }}">


@endsection
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('productlist.Product Details') }}</h4>
            <h6>{{ __('productlist.Full details of a product') }}</h6>
        </div>
    </div>





    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="bar-code-view">
                        <img src="{{ asset('dashboard/assets/img/barcode1.png') }}" alt="barcode">
                        <a class="printimg">
                            <img src="{{ asset('dashboard/assets/img/icons/printer.svg') }}" alt="print">
                        </a>
                    </div>
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Product</h4>
                                <h6>Macbook pro </h6>
                            </li>
                            <li>
                                <h4>Category</h4>
                                <h6>Computers</h6>
                            </li>
                            <li>
                                <h4>Sub Category</h4>
                                <h6>None</h6>
                            </li>
                            <li>
                                <h4>Brand</h4>
                                <h6>None</h6>
                            </li>
                            <li>
                                <h4>Unit</h4>
                                <h6>Piece</h6>
                            </li>
                            <li>
                                <h4>SKU</h4>
                                <h6>PT0001</h6>
                            </li>
                            <li>
                                <h4>Minimum Qty</h4>
                                <h6>5</h6>
                            </li>
                            <li>
                                <h4>Quantity</h4>
                                <h6>50</h6>
                            </li>
                            <li>
                                <h4>Tax</h4>
                                <h6>0.00 %</h6>
                            </li>
                            <li>
                                <h4>Discount Type</h4>
                                <h6>Percentage</h6>
                            </li>
                            <li>
                                <h4>Price</h4>
                                <h6>1500.00</h6>
                            </li>
                            <li>
                                <h4>Status</h4>
                                <h6>Active</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s,</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="slider-product-details">

                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(-354px, 0px, 0px); transition: all 0s ease 0s; width: 709px;">
                                <div class="owl-item" style="width: 324.328px; margin-right: 30px;">
                                    <div class="slider-product">
                                        <img src="assets/img/product/product69.jpg" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 324.328px; margin-right: 30px;">
                                    <div class="slider-product">
                                        <img src="assets/img/product/product69.jpg" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                class="owl-next disabled"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots disabled"></div>

                    </div>
                </div>
            </div>
        </div>





    </div>

@endsection
@section('script')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/owlcarousel/owl.carousel.min.js') }}">

@endsection
