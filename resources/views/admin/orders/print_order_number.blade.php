<!DOCTYPE html>
<html>

<head>
    <title>صفحة قابلة للطباعة</title>
    <style>
        @media print {
            @page {
                size: 105mm 148mm;
            }

            img {
                width: 20mm;
                height: 20mm;
            }



        }
    </style>
    @vite('resources/css/app.css')

</head>

<body>
    <div class="w-full flex flex-col items-center">
        <div class="flex flex-row items-center">
            <img src="{{ $invoice->black_logo }}" alt="">
            <p class="text-4xl font-bold text-black">{{ $invoice->siteName }}</p>
        </div>
        <div class="py-20">{{ $qrcode }}</div>

        <div class="flex flex-col items-center">
            <p class="text-2xl font-bold text-black">{{ $invoice->order_number }}</p>
            <p class="text-2xl font-bold text-black">{{ $invoice->datatime }}</p>
        </div>


    </div>


</body>

</html>
