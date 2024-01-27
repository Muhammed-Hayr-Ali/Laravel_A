@extends('admin.layouts.model_with_title')
@section('title', trans('Order details'))
@section('min-w', 'min-w-[64%]')
@section('max-h', 'max-h-[70vh] ')
@section('body')
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
    </div>
@endsection
@section('Close', trans('Close'))
@section('footer')
    <button value="{{ $order->id }}" id="printButton" class="btn btn-success bg-success-500 text-white"><i
            class="fa-solid fa-print"></i>
        {{ __('Print Order Number') }} </button>
    <div class="w-2"></div>
    <button value="{{ $order->id }}" id="processedButton" class="btn btn-primary bg-primary-700 text-white"><i
            class="fa-solid fa-box-open"></i>
        {{ __('processed') }} </button>
@endsection
<script>
    $(document).ready(function() {
        var printButton = $('#printButton');
        var processedButton = $('#processedButton');


        printButton.click(function() {
            $id = $(this).attr('value');
            axios.post('{{ route('printOrderNumber') }}', {
                "_token": '{{ csrf_token() }}',
                'id': $id
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
                toastr.error(message);

            });
        })



        processedButton.on('click', function() {
            $id = $(this).attr('value');

            $(this).prop('disabled', true);
            $(this).text("{{ __('Loading...') }}");
            axios.post('{{ route('updateOrder') }}', {
                "_token": '{{ csrf_token() }}',
                'id': $id,
                'status': 'Processed'
            }).then(function(response) {
                $(this).text("{{ __('Done') }}");
                location.reload();

            }).catch(function(error) {
                var title = error.response.data.title
                var message = error.response.data.message;
                toastr.error(message)
                $(this).prop('disabled', false);
                $(this).text("{{ __('processed') }}");
            });
        });



    })
</script>
