@extends('dashboard.layouts.master')
@section('title', trans('userList.Users List'))
@section('Users List', 'active')
@section('head')
@endsection
@section('content')





    {{-- page-header --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ __('userList.Users List') }}</h4>
            <h6>{{ __('userList.Manage your users') }}</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('User.create') }}" class="btn btn-added"><img
                    src="{{ asset('dashboard/assets/img/icons/plus.svg') }}" alt="img"
                    class="me-1">{{ __('userList.Add User') }}</a>
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
                                        <select class="select" name="user">
                                            <option value="null">{{ __('productList.Choose user') }}</option>
                                            @foreach ($categories as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (request()->input('user') == $user->id) selected @endif>
                                                    {{ __($user->name) }}
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
                                        <select class="select" name="user">
                                            <option value="null">{{ __('productList.Choose user') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if (request()->input('user') == $user->id) selected @endif>
                                                    {{ __($user->name) }}
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
                    <th>{{ __('userList.User Name') }}</th>
                    <th>{{ __('userList.email') }}</th>
                    {{--   <th>{{ __('userList.Phone') }}</th> --}}
                    <th>{{ __('userList.Role') }}</th>
                    <th>{{ __('userList.Created On') }}</th>
                    <th>{{ __('userList.Status') }}</th>
                    <th>{{ __('userList.Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @if (isset($users) && $users->count() > 0)
                        @foreach ($users as $user)
                            <tr data-id="{{ $user->id }}">
                                <td>{{ __($user->id) }}</td>

                                <td>
                                    <div class="productname">




                                        <div class="">
                                            @if (isset($user->profile) && $user->profile != null)
                                                <a href="{{ asset($user->profile) }}" class=" product-img image-popup"
                                                    data-lightbox="image-1">
                                                    <img src="{{ asset($user->profile) }}" alt="">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="description">
                                            <div class="name ">
                                                <a data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="{{ $user->name }}">
                                                    {{ __($user->name) }}</a>
                                            </div>
                                        </div>
                                    </div>



                                </td>
                                <td>{{ $user->email }}</td>
                                {{--  <td>{{ $user->phone_number }}</td> --}}
                                <td>{{ __($user->role->name) }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>


                                    @if (isset($user->email_verified_at) &&
                                            $user->email_verified_at != null &&
                                            $user->email_verified_at != '0000-00-00 00:00:00')
                                        <button data-id="{{ $user->id }}" type="button"
                                            class=" btn-sm btn btn-success">{{ __('Active') }}</button>
                                    @else
                                        <button data-id="{{ $user->id }}" type="button"
                                            class=" btn-sm btn btn-danger">{{ __('Restricted') }}</button>
                                    @endif

                                </td>
                                <td>
                                    <a class="mx-2" href="{{ route('User.edit', ['User' => $user->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}">
                                        <img src="{{ asset('dashboard/assets/img/icons/edit.svg') }}" alt="img">
                                    </a>

                                    <a class="deleteButton" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ __('Delete') }}"
                                        data-url="{{ route('User.destroy', ['User' => $user->id]) }}"
                                        data-name="{{ __($user->name) }}" data-id="{{ $user->id }}">
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


            $('.btn-danger').on('click', function() {
                var id = $(this).data('id');
                axios.post('{{ route('/userVerify') }}', {
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
                    $('.btn-danger').addClass('btn-success');

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
