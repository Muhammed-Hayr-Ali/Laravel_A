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
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}">

</head>

<body>

    <p class="text-center ">{{ __('product_details.Full details of a product') }}</p>


    <div class="row">
        <div class="col-10">
            <div class="col">
                <h2>{{ $product->productName }}</h2>
                <p class="text-xl">{{ $product->level->name }}/{{ $product->category->name }}</p>
            </div>
        </div>
        <div class="col-2">{{ $qrcode }}</div>
    </div>

    <h4>{{ __('product_details.Description') }}:</h4>
    <h6>{{ $product->description }}</h6>

    <div class="flex flex-row w-full justify-between">
        <div class="flex flex-col items-start">

            <div class="">

            </div>

        </div>

    </div>


    <div>
        <ul>
            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('product_details.Status') }}</h4>
                    <h6>{{ $product->status->name }}</h6>
                </li>

                <li>
                    <h4>{{ __('product_details.Expiration Date') }}</h4>
                    <h6>{{ $product->expiration_date }}</h6>
                </li>

                <div></div>
            </div>
            <li>
            </li>

            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('product_details.Unit') }}</h4>
                    <h6>{{ $product->unit->name }} {{ $product->quantity }}</h6>
                </li>
                <li>
                    <h4>{{ __('product_details.Minimum Qty') }}</h4>
                    <h6>{{ $product->minimumQuantity }}</h6>
                </li>
                <li>
                    <h4>{{ __('product_details.Qty') }}</h4>
                    <h6>{{ $product->availableQuantity }}</h6>
                </li>
            </div>


            <div class="flex flex-row justify-between">
                <li>
                    <h4>{{ __('product_details.Price') }}</h4>
                    <h6>{{ $product->price }}</h6>
                </li>
                <li>
                    <h4>{{ __('product_details.Discount') }}</h4>
                    <h6>{{ $product->discount }}</h6>
                </li>
            </div>



        </ul>
    </div>



</body>

</html>
