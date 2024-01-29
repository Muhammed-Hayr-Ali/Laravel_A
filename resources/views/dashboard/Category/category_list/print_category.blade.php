<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body {
            direction: rtl
        }

        @media print {
            @page {
                size: A4;
            }
        }

        li {
            padding: 20px 0 0 0
        }

        li h4 {
            font-size: 22px;
            font-weight: 600
        }
    </style>
    @vite('resources/css/app.css')

</head>

<body>
    <h6 class="flex justify-center">{{ __('productlist.Full details of a product') }}</h6>

    <div class="flex flex-row w-full justify-between">
        <div class="flex flex-col items-start">
            <p class="text-4xl">{{ $product->name }}</p>
            <div class="">
                <p class="text-xl">{{ $product->level->name }}/{{ $product->category->name }}</p>
            </div>
            <p class="text-xl">{{ $product->brand->name }}</p>
        </div>
        {{ $qrcode }}
    </div>


    <div>
        <ul>
            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('productlist.Status') }}</h4>
                    <h6>{{ $product->status->name }}</h6>
                </li>

                <li>
                    <h4>{{ __('productlist.Expiration Date') }}</h4>
                    <h6>{{ $product->expiration_date }}</h6>
                </li>

                <div></div>
            </div>
            <li>
                <h4>{{ __('productlist.Description') }}:</h4>
                <h6>{{ $product->description }}</h6>
            </li>

            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('productlist.Unit') }}</h4>
                    <h6>{{ $product->unit->name }}</h6>
                </li>
                <li>
                    <h4>{{ __('productlist.Minimum Qty') }}</h4>
                    <h6>{{ $product->minimum_Qty }}</h6>
                </li>
                <li>
                    <h4>{{ __('productlist.Qty') }}</h4>
                    <h6>{{ $product->quantity }}</h6>
                </li>
            </div>


            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('productlist.Price') }}</h4>
                    <h6>{{ $product->price }}</h6>
                </li>
                <li>
                    <h4>{{ __('productlist.Tax') }}</h4>
                    <h6>{{ $product->tax }}</h6>
                </li>
                <li>
                    <h4>{{ __('productlist.Discount') }}</h4>
                    <h6>{{ $product->discount }}</h6>
                </li>
            </div>



        </ul>
    </div>



</body>

</html>
