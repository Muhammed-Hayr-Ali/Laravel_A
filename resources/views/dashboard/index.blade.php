@extends('dashboard.layouts.master')
@section('title', trans('index.Dashboard'))
@section('Dashboard', 'active')
@section('head')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('dashboard/assets/img/icons/potentialOrders.png') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $statistics->potentialOrders }}">0</span></h5>
                    <h6>{{ __('index.Potential Orders') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('dashboard/assets/img/icons/orderDelivered.png') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $statistics->orderDelivered }}">0</span></h5>
                    <h6>{{ __('index.Order Delivered') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('dashboard/assets/img/icons/expiration.png') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $statistics->expired }}">0.0</span></h5>
                    <h6>{{ __('index.Expired') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('dashboard/assets/img/icons/lowStock.png') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $statistics->lowStock }}">0.0</span></h5>
                    <h6>{{ __('index.low Stock') }}</h6>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{ $statistics->newOrders }}</h4>
                    <h5>{{ __('index.New Orders') }}</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{ $statistics->unreadMessages }}</h4>
                    <h5>{{ __('index.Unread Messages') }}</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="mail"></i>
                </div>
            </div>
        </div>



        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{ $statistics->userRegistrations }}</h4>
                    <h5>{{ __('index.User Registrations') }}</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ $statistics->visitors }}</h4>
                    <h5>{{ __('index.Visitors') }}</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="monitor"></i>
                </div>
            </div>
        </div>



    </div>

    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('index.Purchase & Sales') }}</h5>
                    <div class="graph-sets">
                        <ul>
                            <li>
                                <span>{{ __('index.Sales') }}</span>
                            </li>
                            <li>
                                <span>{{ __('index.Purchase') }}</span>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                2022 <img src="{{ asset('dashboard/assets/img/icons/dropdown.svg') }}" alt="img"
                                    class="ms-2">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_charts"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ __('index.Recently Added Products') }}</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="productlist.html" class="dropdown-item">{{ __('index.Products List') }}</a>
                            </li>
                            <li>
                                <a href="addproduct.html" class="dropdown-item">{{ __('index.Add Product') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table dataOnly ">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>{{ __('index.Products') }}</th>
                                    <th>{{ __('index.Price') }}</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($statistics->recentlyAddedProducts as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td class="productimgname">
                                            <a href="{{ route('Product.show', ['Product' => $product->id]) }}"
                                                class="product-img">

                                                @if (isset($product->images()->first()->url))
                                                    <img class="object-cover"
                                                        src="{{ asset($product->images()->first()->url) }}"
                                                        alt="product">
                                                @else
                                                    <img class="object-cover"
                                                        src="{{ asset('dashboard/assets/img/icons/no-image.svg') }}"
                                                        alt="product">
                                                @endif


                                            </a>
                                            <a
                                                href="{{ route('Product.show', ['Product' => $product->id]) }}">{{ substr($product->name, 0, 18) }}</a>
                                        </td>
                                        <td>${{ $product->price }}</td>
                                    </tr>
                                @endforeach






                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">{{ __('index.Expired Products') }}</h4>
            <div class="table-responsive ">
                <table class="table  dataOnly">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>{{ __('index.Product Code') }}</th>
                            <th>{{ __('index.Product Name') }}</th>
                            <th>{{ __('index.Brand Name') }}</th>
                            <th>{{ __('index.Category Name') }}</th>
                            <th>{{ __('index.Expiry Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>




                        @foreach ($statistics->expiredProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><a
                                        href="{{ route('Product.show', ['Product' => $product->id]) }}">{{ $product->code }}</a>
                                </td>
                                <td class="productimgname">
                                    <a class="product-img"
                                        href="{{ route('Product.show', ['Product' => $product->id]) }}">



                                        @if (isset($product->images()->first()->url))
                                            <img class="object-cover" src="{{ asset($product->images()->first()->url) }}"
                                                alt="product">
                                        @else
                                            <img class="object-cover"
                                                src="{{ asset('dashboard/assets/img/icons/no-image.svg') }}"
                                                alt="product">
                                        @endif

                                    </a>
                                    <a
                                        href="{{ route('Product.show', ['Product' => $product->id]) }}">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->brand->name ?? '' }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->expiration_date)->format('Y-m-d') }}
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/apexchart/chart-data.js') }}"></script>
@endsection
