@extends('dashboard.layouts.master')
@section('title', trans('productList.Products List'))
@section('Products List', 'active')
@section('head')
@endsection
@section('content')


    @php
        $categories = \App\Models\Category::all();
        $levels = \App\Models\Level::all();
        $brands = \App\Models\Brand::all();
        $units = \App\Models\Unit::all();
        $status = \App\Models\Status::all();
    @endphp



    {{-- page-header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('productList.Products List') }}</h4>
            <h6>{{ __('productList.Manage your products') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('Product.create') }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('productList.Add New Product') }}</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">

                <div class="search-set">
                    {{-- btn-filter --}}
                    <div class="search-path">
                        @if (isset($hasFilters) && $hasFilters == true)
                            <a class="btn btn-filter setclose" id="filter_search">
                            @else
                                <a class="btn btn-filter" id="filter_search">
                        @endif
                        <img src="{{ asset('dashboard/assets/img/icons/filter.svg') }}" alt="img">
                        <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div>
                    {{-- search-input --}}
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('dashboard/assets/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>

                {{-- Exprot --}}
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('exportPdf') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ __('productList.Export to PDF file') }}"><img
                                    src="{{ asset('dashboard/assets/img/icons/pdf.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{ route('exportExcel') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ __('productList.Export to EXCEL file') }}"><img
                                    src="{{ asset('dashboard/assets/img/icons/excel.s') }}vg" alt="img"></a>
                        </li>
                        <li>
                            <a id="{{ __('productList.Print') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="print"><img src="{{ asset('dashboard/assets/img/icons/printer') }}.svg"
                                    alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>


            @if (isset($hasFilters) && $hasFilters == true)
                <div class="card mb-0" id="filter_inputs" style="display: block;">
                @else
                    <div class="card mb-0" id="filter_inputs">
            @endif

            <div class="card-body pb-0">

                <form action="{{ route('filters') }}" method="POST">
                    @csrf


                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">


                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="category">
                                            <option value="null">{{ __('productList.Choose category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (request()->input('category') == $category->id) selected @endif>
                                                    {{ __($category->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="brand">
                                            <option value="null">{{ __('productList.Choose brand') }}</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    @if (request()->input('brand') == $brand->id) selected @endif>
                                                    {{ __($brand->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="level">
                                            <option value="null">{{ __('productList.Choose level') }}</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}"
                                                    @if (request()->input('level') == $level->id) selected @endif>
                                                    {{ __($level->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="unit">
                                            <option value="null">{{ __('productList.Choose unit') }}</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    @if (request()->input('unit') == $unit->id) selected @endif>
                                                    {{ __($unit->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select" name="status">
                                            <option value="null">{{ __('productList.Choose status') }}</option>
                                            @foreach ($status as $state)
                                                <option value="{{ $state->id }}"
                                                    @if (request()->input('status') == $state->id) selected @endif>
                                                    {{ __($state->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>




                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-filters ms-auto"><img
                                                src="assets/img/icons/search-whites.svg" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table  datanew">
                <thead>

                    <th>id</th>
                    <th>{{ __('productList.Product Name') }}</th>
                    <th>{{ __('productList.Category') }}</th>
                    <th>{{ __('productList.Brand') }}</th>
                    <th>{{ __('productList.Price') }}</th>
                    <th>{{ __('productList.Unit') }}</th>
                    <th>{{ __('productList.Qty') }}</th>
                    <th>{{ __('productList.Status') }}</th>
                    {{-- <th>{{ __('productList.By') }}</th> --}}
                    <th>{{ __('productList.Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (isset($products) && $products->count() > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ __($product->id) }}</td>

                                <td>
                                    <div class="productname">
                                        <div class="">
                                            @if (isset($product->images()->first()->url))
                                                <a href="{{ asset($product->images()->first()->url) }}"
                                                    class="product-img image-popup" data-lightbox="image-1">
                                                    <img src="{{ asset($product->images()->first()->url) }}"
                                                        alt="product">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="name">
                                            <a data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="{{ $product->name }}"
                                                href="{{ route('Product.show', ['Product' => $product->id]) }}">
                                                {{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}</a>
                                        </div>
                                    </div>



                                </td>



                                <td>{{ __($product->category->name) }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ __($product->unit->name) }}</td>
                                <td>{{ __($product->quantity) }}</td>
                                <td>{{ __($product->status->name) }}</td>
                                {{-- <td>{{ \Illuminate\Support\Str::limit($product->user->name, 10, $end = '...') }}</td> --}}
                                <td>
                                    <a class="" href="{{ route('Product.show', ['Product' => $product->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('View') }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    <a class="mx-2" href="{{ route('Product.edit', ['Product' => $product->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>

                                    <a class="deleteButton" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ __('Delete') }}"
                                        data-url="{{ route('Product.destroy', ['Product' => $product->id]) }}"
                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/delete.svg') }}" alt="img">
                                    </a>



                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    </div>





@endsection

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


    <script>
        $(document).ready(function() {

            // Print OK !!
            $("#print").click(function() {
                axios.get('{{ route('printAllProducts') }}', {
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
                var id = $(this).data('id');
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
                            var row = $('.table').find('tr:contains("' + id + '")');
                            row.remove();

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
