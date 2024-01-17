@extends('admin.layouts.master')
@section('Starter Page', 'Control Panel')
@section('title', 'Order')
@section('content')

    <section class="content">

        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Orders') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    @if (@isset($orders) and !@empty($orders))
                        <table class="table table-head-fixed">
                            <thead>
                                <tr>
                                    <th>{{ __('Order ID') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Total Amount') }}</th>
                                    <th>{{ __('Shipping Address') }}</th>
                                    <th>{{ __('Notes') }}</th>
                                    <th>{{ __('Progress') }}</th>








                                </tr style="display: flex; justify-content: center;">
                            </thead>
                            @foreach ($orders as $order)
                                <tbody>
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ __($order->status) }} </td>
                                        <td>{{ $order->created_at->format('Y/m/d') }}</td>
                                        <td>{{ $order->total_amount }}$</td>
                                        <td>
                                            <a href="#" id="addressId"
                                                data-id="{{ $order->address_id }}">{{ $order->address->title }}</a>
                                        </td>
                                        <td>{{ $order->notes }}</td>

                                        <td>
                                            @switch($order->status)
                
                                                @case('Delivered')
                                                    <button type="button" class="btn btn-danger" data-id="{{ $order->id }}"><i class="fas fa-trash-alt"></i></button>
                                                @break

                                                @case('Cancelled')
                                                    <button type="button" class="btn btn-danger" data-id="{{ $order->id }}"><i class="fas fa-trash-alt"></i></button>
                                                @break

                                                @case('Refunded')
                                                    <button type="button" class="btn btn-danger" data-id="{{ $order->id }}"><i class="fas fa-trash-alt"></i></button>
                                                @break
                                                $@default
                                            @endswitch
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <div
                            style="width: 100%;  height: 100%; display: flex; justify-content: center; align-items: center;">
                            {{ __('You don\'t have any orders') }}
                        </div>
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </section>








    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Address details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="myModalbody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on("click", '#addressId', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route('address') }}',
                    type: 'POST',
                    dataType: 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(response) {
                        console.log(response);
                        $('#myModalbody').html(response);
                        $('#myModal').modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                        alert(error.responseText);
                    }
                });
            });
        });
    </script>
@endsection
