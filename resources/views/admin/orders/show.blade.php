@if (@isset($order) and !@empty($order))
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-2">{{ __('#') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Product') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Quantity') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Price') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Total Price') }}</th>
            </tr>
        </thead>
        <tbody>



            @foreach ($order->productOrder as $key => $product)
                <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-2 px-6">{{ $key }}</td>
                    <td class="py-2 px-6">{{ $product->product->name }}</td>
                    <td class="py-2 px-6">{{ $product->quantity }}</td>
                    <td class="py-2 px-6">{{ $product->price }}</td>
                    <td class="py-2 px-6 font-bold">{{ $product->totalprice }}</td>
                </tr>
            @endforeach



            <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-2 px-6" colspan="4"></td>
                <td class="py-4 px-6 font-bold">{{ __('Total') }}: <p class="font-extrabold text-xl py-2">
                        {{ $order->totalOrder }}</p>
                </td>
            </tr>
        </tbody>
    </table>
@else
    <div class="w-full  bg-white flex justify-center items-center"><img
            src="{{ asset('assets/admin/dist/img/no_orders.jpg') }}" alt=""></div>
@endif
