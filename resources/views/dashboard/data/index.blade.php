@extends('dashboard.layouts.master')
@section('title', trans($name . ' title'))
@section($name . ' List', 'active')
@section('head')
@endsection
@section('content')





    {{-- page-header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __($name . ' title') }}</h4>
            <h6>{{ __($name . ' subtitle') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('create', ['name' => $name]) }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('Add ' . $name) }}</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">

                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('dashboard/assets/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>


            </div>
        </div>

        <div class="table-responsive">
            <table class="table  dataTableSearch">
                <thead>

                    <th>id</th>
                    <th>{{ __($name . ' name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Created By') }}</th>
                    <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (isset($values) && $values->count() > 0)
                        @foreach ($values as $value)
                            <tr data-id="{{ $value->id }}">
                                <td>{{ __($value->id) }}</td>
                                <td>
                                    <div class="productname">
                                        <div class="">
                                            @if (isset($value->image) && $value->image != null)
                                                <a href="{{ asset($value->image) }}" class="product-img image-popup"
                                                    data-lightbox="image-1">
                                                    <img src="{{ asset($value->image) }}" alt="">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="name">
                                            <a data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="{{ $value->name }}">
                                                {{ __($value->name) }}</a>
                                        </div>
                                    </div>



                                </td>
                                <td class="description">{{ $value->description }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>

                                    <a class="mx-2" href="{{ route('edit', ['name' => $name, 'id' => $value->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>

                                    <a class="deleteButton" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ __('Delete') }}"
                                        data-url="{{ route('delete', ['name' => $name, 'id' => $value->id]) }}"
                                        data-name="{{ __($value->name) }}" data-id="{{ $value->id }}">
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

            if ($('.dataTableSearch').length > 0) {
                $('.dataTableSearch').DataTable({
                    "order": [
                        [0, 'asc']
                    ],
                    "info": false,
                    "paging": false,
                    "bFilter": true,
                    "ordering": true,

                    "sDom": 'fBtlpi',
                    'pagingType': 'numbers',
                    "language": {
                        emptyTable: "{{ __('dataTable.No data available in table') }}",
                        info: "{{ __('dataTable.Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        infoEmpty: "{{ __('dataTable.Showing 0 to 0 of 0 entries') }}",
                        infoFiltered: "{{ __('dataTable.(filtered from _MAX_ total entries)') }}",
                        lengthMenu: "{{ __('dataTable.View per page: _MENU_') }}",
                        loadingRecords: "{{ __('dataTable.Loading...') }}",
                        processing: "{{ __('dataTable.processing') }}",
                        search: " ",
                        zeroRecords: "{{ __('dataTable.No matching records found') }}",

                        first: "{{ __('dataTable.First') }}",
                        last: "{{ __('dataTable.Last') }}",
                        Next: "{{ __('dataTable.Next') }}",
                        previous: "{{ __('dataTable.Previous') }}",

                        sortAscending: "{{ __('dataTable.: activate to sort column ascending') }}",
                        sortDescending: "{{ __('dataTable.: activate to sort column descending') }}",




                        sLengthMenu: '_MENU_',
                        searchPlaceholder: "{{ __('dataTable.Search...') }}",
                    },
                    initComplete: (settings, json) => {
                        $('.dataTables_filter').appendTo('#tableSearch');
                        $('.dataTables_filter').appendTo('.search-input');
                    },
                });
            }

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
