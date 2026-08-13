<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        Invoice - {{ $sale->invoice_number }}
    </title>

    <style>

        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #222;
        }

        .container {
            width: 100%;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #222;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: bold;
            text-align: right;
        }

        .invoice-number {
            text-align: right;
            margin-top: 5px;
        }

        .customer-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .customer-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .customer-table td {
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items-table th {
            background-color: #eeeeee;
            border: 1px solid #cccccc;
            padding: 9px;
            text-align: left;
        }

        .items-table td {
            border: 1px solid #cccccc;
            padding: 9px;
        }

        .center {
            text-align: center;
        }

        .total-table {
            width: 300px;
            margin-left: auto;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .total-table td {
            padding: 8px;
        }

        .grand-total {
            border-top: 2px solid #222;
            font-size: 17px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            padding-top: 15px;
            border-top: 1px solid #cccccc;
            text-align: center;
            color: #666666;
        }

    </style>
</head>

<body>

<div class="container">

    {{-- Header --}}
    <table class="header-table">
        <tr>

            <td>

                <div class="company-name">
                    MINI INVENTORY MANAGEMENT By omkar Deshmukh
                </div>

                <div>
                    Sales Invoice
                </div>

            </td>

            <td class="invoice-title">

                INVOICE

                <div class="invoice-number">
                    <strong>Invoice:</strong>
                    {{ $sale->invoice_number }}
                </div>

                <div class="invoice-number">
                    <strong>Date:</strong>
                    {{ $sale->sale_date->format('d-m-Y') }}
                </div>

            </td>

        </tr>
    </table>


    {{-- Customer Information --}}
    <table class="customer-table">

        <tr>

            <td width="50%">

                <div class="customer-title">
                    BILL TO
                </div>

                <div>
                    <strong>
                        {{ $sale->customer->name }}
                    </strong>
                </div>

                @if($sale->customer->phone)
                    <div>
                        Phone:
                        {{ $sale->customer->phone }}
                    </div>
                @endif

                @if($sale->customer->email)
                    <div>
                        Email:
                        {{ $sale->customer->email }}
                    </div>
                @endif

            </td>

            <td width="50%" class="right">

                <div class="customer-title">
                    INVOICE INFORMATION
                </div>

                <div>
                    <strong>Invoice:</strong>
                    {{ $sale->invoice_number }}
                </div>

                <div>
                    <strong>Date:</strong>
                    {{ $sale->sale_date->format('d-m-Y') }}
                </div>

            </td>

        </tr>

    </table>


    {{-- Products --}}
    <table class="items-table">

        <thead>

            <tr>

                <th width="7%">
                    #
                </th>

                <th width="43%">
                    Product
                </th>

                <th width="12%" class="center">
                    Qty
                </th>

                <th width="19%" class="right">
                    Unit Price
                </th>

                <th width="19%" class="right">
                    Total
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($sale->items as $item)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->product->name }}
                    </td>

                    <td class="center">
                        {{ $item->quantity }}
                    </td>

                    <td class="right">
                        ₹{{ number_format($item->unit_price, 2) }}
                    </td>

                    <td class="right">
                        ₹{{ number_format($item->total_price, 2) }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    {{-- Total --}}
    <table class="total-table">

        <tr>

            <td>
                Subtotal
            </td>

            <td class="right">
                ₹{{ number_format($sale->total_amount, 2) }}
            </td>

        </tr>

        <tr class="grand-total">

            <td>
                Grand Total
            </td>

            <td class="right">
                ₹{{ number_format($sale->total_amount, 2) }}
            </td>

        </tr>

    </table>


    {{-- Footer --}}
    <div class="footer">

        <strong>
            Thank you for your business!
        </strong>

        <br>

        MINI INVENTORY MANAGEMENT

    </div>

</div>

</body>

</html>
