@if (@isset($order) and !@empty($order))
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-2 flex justify-center">{{ __('#') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Product') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Quantity') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Price') }}</th>
                <th scope="col" class="py-3 px-6">{{ __('Total Price') }}</th>
            </tr>
        </thead>
        <tbody>



            @foreach ($order->products as $key => $product)
                <tr class="bg-white hover:bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-2 px-6 font-bold">{{ $key + 1 }}</td>
                    <td class="py-2 px-6">{{ $product->product->name }}</td>
                    <td class="py-2 px-6">{{ $product->quantity }}</td>
                    <td class="py-2 px-6">{{ $product->price }} $</td>
                    <td class="py-2 px-6 font-bold">{{ $product->totalprice }} $</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="w-full flex justify-end ">
        <div class="flex-col p-3 space-y-2 ">
            <p class="text-sm font-bold">{{ __('Total') }}</p>
            <p class="text-lg font-extrabold">{{ $order->amount }} $</p>
        </div>
    @else
        <div class="w-full h-full flex justify-center items-center">
            <b>{{ __('Unable to retrieve order details') }}</b>
        </div>
@endif
