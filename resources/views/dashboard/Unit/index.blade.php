@extends('dashboard.layouts.master')
@section('title', trans('unitList.Product Units list'))
@section('Product', 'active')
@section('UnitList', 'active')
@section('head')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.css') }}">
@endsection
@section('content')







    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('unitList.Product Units list') }}</h4>
            <h6>{{ __('unitList.View/Edit product Unit') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('Unit.create') }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('unitList.Add Unit') }}</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">

                    {{-- <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('dashboard/assets/img/icons/filter.svg') }}" alt="img">
                            <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div> --}}

                    <div class="search-set">

                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="{{ asset('dashboard/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>
                                    <input id="input" oninput="search()" type="search"
                                        class="form-control form-control-sm" placeholder="{{ __('unitList.Search...') }}"
                                        aria-controls="DataTables_Table_0"></label>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('exportPdf') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="pdf"><img src="{{ asset('dashboard/assets/img/icons/pdf.svg') }}"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a href="{{ route('exportExcel') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="excel"><img src="{{ asset('dashboard/assets/img/icons/excel.svg') }}"
                                    alt="img"></a>
                        </li>
                        <li>
                            <a id="print" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{ asset('dashboard/assets/img/icons/printer.svg') }}" alt="img"></a>
                        </li>
                    </ul>
                </div> --}}
            </div>


            {{--
            <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                    <form action="{{ route('filters') }}" method="POST">
                        @csrf

                        <div class="w-full flex flex-row space-x-2 pb-4">

                            <div></div>

                            <div class="flex flex-row items-center">
                                <div class="pl-1">{{__('unitList.Category') }}</div>
                                <div class="w-40">
                                    <select class="select" name="category">
                                        <option value="all">{{__('unitList.All') }}</option>
                                        @php
                                            $categories = \App\Models\Category::all();
                                        @endphp
                                        @foreach ($categories as $unit)
                                            <option value="{{ $unit->id }}"
                                                @if (request()->input('category') == $unit->id) selected @endif>
                                                {{ __('category.' . $unit->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-row items-center">
                                <div class="pl-1">{{__('unitList.Brand') }}</div>
                                <div class="w-40">
                                    <select class="select" id="brand" name="brand">
                                        <option value="all">{{__('unitList.All') }}</option>
                                        @php
                                            $brands = \App\Models\Brand::all();
                                        @endphp
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @if (request()->input('brand') == $brand->id) selected @endif>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-row items-center">
                                <div class="pl-1">{{__('unitList.Unit') }}</div>
                                <div class="w-40">
                                    <select id="unit" class="select" name="unit">
                                        <option value="all">{{__('unitList.All') }}</option>
                                        @php
                                            $units = \App\Models\Unit::all();
                                        @endphp
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                @if (request()->input('unit') == $unit->id) selected @endif>
                                                {{ __('unit.' . $unit->name) }}</option>
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                            <div class=" flex flex-auto justify-end">

                                <div class="">
                                    <button type="submit" class="btn btn-primary"><img
                                            src="{{ asset('dashboard/assets/img/icons/search-whites.svg') }}"
                                            alt="img"></button>
                                </div>
                            </div>




                        </div>
                    </form>
                </div>
            </div> --}}



            @if (isset($units) && $units->count() > 0)

                <div class="table-responsive">
                    <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="table" class="table " role="grid" aria-describedby="table_info">
                            <thead>

                                <th>{{ __('unitList.Unit name') }}</th>
                                <th>{{ __('unitList.Description') }}</th>
                                <th>{{ __('unitList.Created By') }}</th>
                                <th>{{ __('unitList.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>





                                @foreach ($units as $unit)
                                    <tr class="even">

                                        <td class="">
                                            <div class="flex flex-row space-x-2 items-center h-full">
                                                <div></div>
                                                <div class="product-img">
                                                    @if ($unit->image != null)
                                                        <a href="{{ asset($unit->image) }}"class="image-popup"
                                                            data-lightbox="image-1"> <img class="object-cover"
                                                                src="{{ asset($unit->image) }}" alt="category"></a>
                                                    @else
                                                        <img class="object-cover"
                                                            src="{{ asset('dashboard/assets/img/icons/no-image.svg') }}"
                                                            alt="product">
                                                    @endif
                                                </div>

                                                <a href="#">{{ __($unit->name) }}</a>
                                            </div>
                                        </td>
                                        <td class="max-w-[250px] overflow-auto text-wrap text-end">
                                            {{ $unit->description }}</td>
                                        <td class="max-w-[250px] overflow-auto text-wrap text-end">
                                            {{ $unit->user->name }}</td>
                                        <td>


                                            <div class="flex flex-row space-x-4 ">
                                                <div></div>
                                                {{-- <a class="" href="#">
                                                    <img src="{{ asset('dashboard/assets/img/icons/eye.svg') }}"
                                                        alt="img">
                                                </a> --}}
                                                <a class="" href="{{ route('Unit.edit', ['Unit' => $unit->id]) }}">
                                                    <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}"
                                                        alt="img">
                                                </a>
                                                <a class="deleteButton"
                                                    data-url="{{ route('Unit.destroy', ['Unit' => $unit->id]) }}"
                                                    data-name="{{ $unit->name }}">
                                                    <img src="{{ asset('dashboard/assets/img/icons/delete.svg') }}"
                                                        alt="img">
                                                </a>



                                            </div>

                                        </td>

                                    </tr>
                                @endforeach







                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex flex-row justify-between pt-8">
                    <div class=""> {{ $units->links('dashboard.pagination.default') }}</div>

                    <div class="flex  flex-row items-center">
                        <p>{{ __('unitList.Show per page') }}</p>
                        <form action="{{ route('Category.index') }}" method="GET">
                            <select name="perPage" onchange="this.form.submit()"
                                class=" mr-1 custom-select
                        custom-select-sm form-control form-control-sm">
                                <option {{ $units->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option {{ $units->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option {{ $units->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option {{ $units->perPage() == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>


                </div>
            @else
                <div class="card h-72 ">
                    <div class="h-full flex flex-col justify-center items-center space-y-3 ">
                        <img style="width: 128px;" src="{{ asset('dashboard/assets/img/icons/empty-box.png') }}"
                            alt="img">
                        <h4>{{ __('unitList.No Data Found') }}</h4>
                    </div>
                </div>
            @endif

        </div>
    </div>








@endsection
@section('script')
    <script src="{{ asset('dashboard/assets/plugins/lightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/lightbox/lightbox.js') }}"></script>

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

            // Search OK!!
            $("#input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).find('td:eq(0)').text().toLowerCase().indexOf(value) > -
                        1)
                });
            });

            // // Print OK !!
            // $("#print").click(function() {
            //     axios.get('{{ route('printAllProducts') }}', {
            //         "_token": '{{ csrf_token() }}',
            //     }).then(function(response) {
            //         var iframe = document.createElement('iframe');
            //         iframe.style.display = 'none';
            //         document.body.appendChild(iframe);
            //         var iframeDoc = iframe.contentWindow.document;
            //         iframeDoc.open();
            //         iframeDoc.write(response.data);
            //         iframeDoc.close();
            //         iframe.contentWindow.print();
            //     }).catch(function(error) {
            //         var message = error.response.data.message;
            //         Swal.fire({
            //             title: "{{ __('unitList.Error') }}",
            //             text: message,
            //             icon: "error",
            //             confirmButtonText: "{{ __('unitList.Ok') }}",
            //         });

            //     });
            // })

            // Delete OK !!
            $('.deleteButton').on('click', function() {
                var url = $(this).data('url');
                var name = $(this).data('name');

                Swal.fire({
                    title: "{{ __('swal_fire.Delete') }}",
                    html: `{{ __('swal_fire.Are you sure you want to delete :value and the images associated with it?', ['value' => '  ${name}  ']) }},`,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('swal_fire.Delete') }}",
                    cancelButtonText: "{{ __('swal_fire.Cancel') }}",

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
                            var row = $('#table').find('tr:contains("' + name + '")');
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
