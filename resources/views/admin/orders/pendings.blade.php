@extends('admin.layouts.master')
@section('title', trans('Pendings'))
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


    <div class="w-full py-3 flex justify-end">



        <form action="{{ route('searchPendings') }}" method="POST">
            @csrf
            <div class="flex w-[30%] items-center space-x-2">
                <input type="text" name="key"
                    class=" relative m-0 block w-[300px]  flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none motion-reduce:transition-none dark:border-neutral-500 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                    placeholder="{{ __('Search by Order Number') }}" aria-label="Search" aria-describedby="button-addon2"
                    value="{{ $key ?? '' }}">

                <div></div>
                <button type="submit"
                    class="input-group-text flex items-center whitespace-nowrap rounded px-3 py-1.5 text-center text-base font-normal text-neutral-700 dark:text-neutral-200"
                    id="basic-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>


    </div>
    @if (@isset($orders) and count($orders) > 0)

        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('Order Number') }}</th>
                    <th scope="col" class="w-[20%] py-3 px-2  text-center">{{ __('User Name') }}</th>
                    <th scope="col" class="w-[10%] py-3 px-2  text-center">{{ __('Products') }}</th>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('Amount') }}</th>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('Order Time') }}</th>
                    <th scope="col" class="w-auto py-3 px-2">{{ __('Notes') }}</th>
                    <th scope="col" class="w-[13%] py-3 px-2  text-center">{{ __('View order') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-2  text-center"><b>{{ $order->order_number }}</b></td>
                        <td class="py-4 px-2 text-center"><a href="#" class="showUserModal"
                                value="{{ $order->user_id }}">{{ $order->userName }}</a></td>
                        <td class="py-4 px-2  text-center">{{ $order->quantity }}</td>
                        <td class="py-4 px-2  text-center"><b>{{ $order->amount }} $</b></td>
                        <td class="py-4 px-2  text-center">{{ $order->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-2">{{ $order->notes }}</td>
                        <td class="py-4 px-2  text-center"><button value="{{ $order->id }}" type="button"
                                class="showOrderModal btn btn-block btn-primary bg-primary-700">
                                {{ __('View') }}
                            </button></td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div class="w-full h-[65vh] flex flex-col justify-center items-center space-y-3">

            <i class="fa-solid fa-cart-shopping text-6xl text-secondary-200"></i>
            <p class="text-secondary-700">{{ __('There are no Orders pending review') }}</p>
        </div>
    @endif






    {{-- Modal --}}
    <div class="modal fade " id="Modal" role="dialog"></div>



@endsection
@section('script')
    <script>
        toastr.options = {
            "positionClass": "toast-top-left",
        }




        $(document).ready(function() {


            var showOrderModal = $('.showOrderModal');
            var showUserModal = $('.showUserModal');
            var Modal = $('#Modal');
            var orderId;




            showOrderModal.each(function() {
                var button = $(this);
                button.on('click', function() {
                    $id = $(this).attr('value');
                    orderId = $id;
                    axios.post('{{ route('showOrder') }}', {
                        "_token": '{{ csrf_token() }}',
                        'id': $id
                    }).then(function(response) {
                        console.log(response);
                        Modal.html(response.data);
                        Modal.modal('show');

                    }).catch(function(error) {
                        var title = error.response.data.title
                        var message = error.response.data.message;
                        toastr.error(message)

                    });
                });
            });









            showUserModal.each(function() {
                var button = $(this);
                var userModal = $('#userModal')

                button.on('click', function() {
                    $id = $(this).attr('value');
                    axios.post('{{ route('userProfile') }}', {
                        "_token": '{{ csrf_token() }}',
                        'id': $id
                    }).then(function(response) {
                        console.log(response);
                        Modal.html(response.data);
                        Modal.modal('show');

                    }).catch(function(error) {
                        var title = error.response.data.title
                        var message = error.response.data.message;
                        toastr.error(message)
                    });
                });
            });
        });
    </script>
@endsection
