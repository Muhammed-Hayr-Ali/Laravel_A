@extends('dashboard.layouts.master')
@section('title', trans('categoryList.Product Categories list'))
@section('Category List', 'active')
@section('head')
@endsection
@section('content')





    {{-- page-header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('categoryList.Product Categories list') }}</h4>
            <h6>{{ __('categoryList.View/Edit product Category') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('Category.create') }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('categoryList.Add Category') }}</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">

                <div class="search-set">
                    {{-- btn-filter --}}
                    {{-- <div class="search-path">
                        @if (isset($hasFilters) && $hasFilters == true)
                            <a class="btn btn-filter setclose" id="filter_search">
                            @else
                                <a class="btn btn-filter" id="filter_search">
                        @endif
                        <img src="{{ asset('dashboard/assets/img/icons/filter.svg') }}" alt="img">
                        <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div> --}}
                    {{-- search-input --}}
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('dashboard/assets/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>

                {{-- Exprot --}}
                {{-- <div class="wordset">
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
                </div> --}}
            </div>


            {{-- @if (isset($hasFilters) && $hasFilters == true)
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
            </div> --}}
        </div>

        <div class="table-responsive">
            <table class="table  dataSearch">
                <thead>

                    <th>id</th>
                    <th>{{ __('categoryList.Category name') }}</th>
                    <th>{{ __('categoryList.Description') }}</th>
                    <th>{{ __('categoryList.Created By') }}</th>
                    <th>{{ __('categoryList.Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (isset($categorise) && $categorise->count() > 0)
                        @foreach ($categorise as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ __($category->id) }}</td>

                                <td>
                                    <div class="productname">
                                        <div class="">
                                            @if (isset($category->image) && $category->image != null)
                                                <a href="{{ asset($category->image) }}" class="product-img image-popup"
                                                    data-lightbox="image-1">
                                                    <img src="{{ asset($category->image) }}" alt="">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="name">
                                            <a data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="{{ $category->name }}">
                                                {{ __($category->name) }}</a>
                                        </div>
                                    </div>



                                </td>
                                <td class="description">{{ $category->description }}</td>
                                <td>{{ $category->user->name }}</td>
                                <td>

                                    <a class="mx-2" href="{{ route('Category.edit', ['Category' => $category->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>

                                    <a class="deleteButton" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ __('Delete') }}"
                                        data-url="{{ route('Category.destroy', ['Category' => $category->id]) }}"
                                        data-name="{{ __($category->name) }}" data-id="{{ $category->id }}">
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
                            var row = $('.table').find('tr[data-id="' + id + '"]');
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
