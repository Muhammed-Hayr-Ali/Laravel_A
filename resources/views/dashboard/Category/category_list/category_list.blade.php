@extends('dashboard.layouts.master')
@section('title', trans('productlist.Product'))
@section('Product', 'active')
@section('productlist', 'active')
@section('head')
@endsection
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('productlist.Product List') }}</h4>
            <h6>{{ __('productlist.Manage your products') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('addproduct') }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('productlist.Add New Product') }}</a>
        </div>
    </div>

    @if (isset($products) && $products->count() > 0)
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
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('productlist.Search...') }}"
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



                @include('dashboard.Product.product_list.component.filters')





                <div class="table-responsive">
                    <div id="table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="table" class="table " role="grid" aria-describedby="table_info">
                            <thead>

                                <th>{{ __('productlist.Product Name') }}</th>
                                <th>{{ __('productlist.Code') }}</th>
                                <th>{{ __('productlist.Category') }}</th>
                                <th>{{ __('productlist.Brand') }}</th>
                                <th>{{ __('productlist.Price') }}</th>
                                <th>{{ __('productlist.Unit') }}</th>
                                <th>{{ __('productlist.Qty') }}</th>
                                <th>{{ __('productlist.By') }}</th>
                                <th>{{ __('productlist.Action') }}</th>
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
                                                <a class=""
                                                    href="{{ route('productDetails', ['id' => $product->id]) }}">
                                                    <img src="{{ asset('dashboard/assets/img/icons/eye.svg') }}"
                                                        alt="img">
                                                </a>
                                                <a class="" href="editproduct.html">
                                                    <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}"
                                                        alt="img">
                                                </a>
                                                <button class="deleteButton" data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-short="{{ \Illuminate\Support\Str::limit($product->name, 10, $end = '...') }}">
                                                    <img src="{{ asset('dashboard/assets/img/icons/delete.svg') }}"
                                                        alt="img">
                                                </button>



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
                        <p>{{ __('productlist.Show per page') }}</p>
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
    @else
        <div class="card h-96 ">
            <div class="h-full flex flex-col justify-center items-center space-y-3 ">
                <img style="width: 128px;" src="{{ asset('dashboard/assets/img/icons/empty-box.png') }}" alt="img">
                <h4>{{ __('productlist.No Data Found') }}</h4>
            </div>
        </div>
    @endif








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
                axios.get('{{ route('printList') }}', {
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






            $('.deleteButton').on('click', function() {
                var id = $(this).data('id');
                var short = $(this).data('short');
                var name = $(this).data('name');

                Swal.fire({
                    title: "{{ __('productlist.Delete') }}",
                    html: `{{ __('productlist.Are you sure you want to delete the product?') }} <br><br><b>${name}</b>`,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "{{ __('productlist.Cancel') }}",
                    denyButtonText: "{{ __('productlist.Delete') }}"
                }).then((result) => {


                    if (result.isDenied) {
                        axios.post('{{ route('deleteProduct') }}', {
                            "_token": '{{ csrf_token() }}',
                            "id": id
                        }).then(function(response) {
                            var message = response.data.message;
                            Swal.fire({
                                icon: "success",
                                title: message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var row = $('#table').find('tr:contains("' + short + '")');
                            row.remove();

                        }).catch(function(error) {
                            var message = error.response.data.message;
                            Swal.fire(message, "", "info");

                        });

                    }

                });

            });








        });
    </script>
@endsection
