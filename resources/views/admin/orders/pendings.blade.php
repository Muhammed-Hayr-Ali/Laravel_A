@extends('admin.layouts.master')
@section('title', trans('Pending'))
@section('content-header')
    <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-200">{{ __('Orders') }}</span>
    </li>
    <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-200">/</span>
    </li>
    <li>
        <a href="{{ route('pendings') }}"
            class="text-neutral-500 transition duration-200 hover:text-neutral-600 hover:ease-in-out motion-reduce:transition-none dark:text-neutral-200">{{ __('Pendings') }}</a>
    </li>
@endsection
@section('Orders', 'active')
@section('Pending', 'active')
@section('content')



    @if (@isset($pendings) and !$pendings)

        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
        <div class="w-full py-3 flex justify-end">
            <div class="flex w-[30%] items-center space-x-2">
                <input type="search"
                    class="relative m-0 block w-[1px] min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none motion-reduce:transition-none dark:border-neutral-500 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                    placeholder="Search" aria-label="Search" aria-describedby="button-addon2" />

                <div></div>
                <button
                    class="input-group-text flex items-center whitespace-nowrap rounded px-3 py-1.5 text-center text-base font-normal text-neutral-700 dark:text-neutral-200"
                    id="basic-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">{{ __('ID') }}</th>
                    <th scope="col" class="py-3 px-6">{{ __('User Name') }}</th>
                    <th scope="col" class="py-3 px-6">{{ __('Products') }}</th>
                    <th scope="col" class="py-3 px-6">{{ __('Amount') }}</th>
                    <th scope="col" class="py-3 px-6">{{ __('Order Time') }}</th>
                    <th scope="col" class="py-3 px-6">{{ __('View order') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendings as $pending)
                    <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6">{{ $pending->id }}</td>
                        <td class="py-4 px-6 font-weight-bold">{{ $pending->user->name }}</td>
                        <td class="py-4 px-6">{{ $pending->productOrder->sum('quantity') }}</td>

                        @php
                            $total = 0;
                        @endphp

                        @foreach ($pending->productOrder as $order)
                            @php
                                $total += $order->price * $order->quantity;
                            @endphp
                        @endforeach
                        <td class="py-4 px-6">$ {{ $total }}</td>
                        <td class="py-4 px-6">{{ $pending->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-6">
                            <button data-value="{{ $pending->id }}" type="button"
                                class="btn btn-block btn-primary bg-primary-500 btn-show-modal">
                                {{ __('View') }}
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div class="w-full  bg-white flex justify-center items-center">لايوجد</div>
    @endif






    {{-- Model --}}
    <div class="modal fade " id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Order details') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overflow-auto scroll max-h-[70vh] " id="myModalbody">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default bg-default-500"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="processed" type="button"
                        class="btn btn-primary bg-primary-500">{{ __('processed') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var orderId;
            var buttons = $('.btn-show-modal');
            var processed = $('#processed');
            buttons.each(function() {
                var button = $(this);
                button.on('click', function() {
                    var id = button.data('value');
                    orderId = id;
                    $.ajax({
                        url: '{{ route('showOrder') }}',
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
                            $('#myModalbody').html(response);
                            $('#myModal').modal('show');
                        }
                    });

                });
            });



            processed.on('click', function() {
                processed.prop('disabled', true);
                processed.text('Loading...');

                $.ajax({
                    url: '{{ route('updateOrder') }}',
                    type: 'POST',
                    dataType: 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'id': orderId,
                        'status': 'Processed'
                    },
                    success: function(response) {
                        console.log(response);
                        processed.text('Done');
                        $('#myModal').modal('hide');
                        location.reload();
                    },
                    error: function(error) {
                        processed.prop('disabled', false);
                        processed.text('processed');

                    }
                });

            });






        });
    </script>
@endsection
