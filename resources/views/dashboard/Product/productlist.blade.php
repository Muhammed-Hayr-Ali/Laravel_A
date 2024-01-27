@extends('dashboard.layouts.master')
@section('title', trans('Product'))
@section('Product', 'active')
@section('productlist', 'active')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('Product List') }}</h4>
            <h6>{{ __('Manage your products') }}</h6>
        </div>
        <div class="page-btn">
            <a href="addproduct.html" class="btn btn-added"><img src="{{ asset('dashboard/assets/img/icons/plus.svg') }}"
                    alt="img" class="me-1">{{ __('Add New Product') }}</a>
        </div>
    </div>






    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('dashboard/assets/img/icons/filter.svg') }}" alt="img">
                            <span><img src="{{ asset('dashboard/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div>

                    <div class="search-set">

                        <div class="search-input">
                            <a class="btn btn-searchset"><img
                                    src="{{ asset('dashboard/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>
                                    <input id="input" oninput="search()" type="search"
                                        class="form-control form-control-sm" placeholder="{{ __('Search...') }}"
                                        aria-controls="DataTables_Table_0"></label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="wordset">
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
                </div>
            </div>



            @include('dashboard.Product.component.filters')





            <div class="table-responsive">
                <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <table id="table" class="table " role="grid" aria-describedby="table_info">
                        <thead>

                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('price') }}</th>
                            <th>{{ __('Unit') }}</th>
                            <th>{{ __('Qty') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>





                            @foreach ($products as $product)
                                <tr class="even">

                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">




                                            @if (isset($product->images()->first()->url))
                                                <img class="object-cover"
                                                    src="{{ asset($product->images()->first()->url) }}" alt="product">
                                            @else
                                                <img class="object-cover"
                                                    src="{{ asset('dashboard/assets/img/icons/no-image.svg') }}"
                                                    alt="product">
                                            @endif





                                        </a>

                                        <a
                                            href="javascript:void(0);">{{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}</a>
                                    </td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ __('category.' . $product->category->name) }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ __('unit.' . $product->unit->name) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($product->user->name, 8, $end = '...') }}
                                    </td>
                                    <td>


                                        <div class="flex flex-row space-x-4">
                                            <div></div>
                                            <a class="" href="product-details.html">
                                                <img src="{{ asset('dashboard/assets/img/icons/eye.svg') }}"
                                                    alt="img">
                                            </a>
                                            <a class="" href="editproduct.html">
                                                <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}"
                                                    alt="img">
                                            </a>
                                            <a class="" class="confirm-text" href="javascript:void(0);">
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
                <div class=""> {{ $products->links('dashboard.pagination.default') }}</div>

                <div class="flex  flex-row items-center">
                    <p>{{ __('general.Show per page') }}</p>
                    <form action="{{ route('productlist') }}" method="GET">
                        <select name="perPage" onchange="this.form.submit()"
                            class=" mr-1 custom-select
                        custom-select-sm form-control form-control-sm">
                            <option {{ $products->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option {{ $products->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option {{ $products->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option {{ $products->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {


            $("#input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).find('td:eq(0)').text().toLowerCase().indexOf(value) > -
                        1)
                });
            });








            $("#print").click(function() {
                axios.get('{{ route('print') }}', {
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

                });
            })






        });
    </script>
@endsection
