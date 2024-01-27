<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        @media print {
            @page {
                size: A4;
            }
        }

        body {
            direction: rtl;
        }

        .tg {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-cly1 {
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-lboi {
            font-weight: 900;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }
    </style>
</head>

<body>
    <table class="tg">
        <thead>
            <tr>
                <th class="tg-lboi">Product Name</th>
                <th class="tg-lboi">Code</th>
                <th class="tg-lboi">Category</th>
                <th class="tg-lboi">Brand</th>
                <th class="tg-lboi">price</th>
                <th class="tg-lboi">Unit</th>
                <th class="tg-lboi">Qty</th>
                <th class="tg-lboi">Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="tg-cly1">{{ $product->name }}</td>
                    <td class="tg-cly1">{{ $product->code }}</td>
                    <td class="tg-cly1">{{ $product->category->name }}</td>
                    <td class="tg-cly1">{{ $product->brand->name }}</td>
                    <td class="tg-cly1">{{ $product->price }}</td>
                    <td class="tg-cly1">{{ $product->unit->name }}</td>
                    <td class="tg-cly1">{{ $product->quantity }}</td>
                    <td class="tg-cly1">{{ $product->user->name }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
