<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Invoice Details - {{ $sale->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <!-- Header -->
                <div class="flex justify-between border-b pb-4 mb-4">

                    <div>
                        <h3 class="text-lg font-bold">
                            Customer
                        </h3>

                        <p>
                            {{ $sale->customer->name }}
                        </p>

                        @if($sale->customer->phone)
                            <p>
                                {{ $sale->customer->phone }}
                            </p>
                        @endif
                    </div>

                    <div class="text-right">

                        <p>
                            <strong>Date:</strong>
                            {{ $sale->sale_date->format('d-m-Y') }}
                        </p>

                        <p>
                            <strong>Invoice:</strong>
                            {{ $sale->invoice_number }}
                        </p>

                    </div>

                </div>

                <!-- Items -->
                <table class="w-full border-collapse mb-4">

                    <thead>

                        <tr class="bg-gray-100 border-b">

                            <th class="p-2 text-left">
                                Product
                            </th>

                            <th class="p-2 text-center">
                                Qty
                            </th>

                            <th class="p-2 text-right">
                                Price
                            </th>

                            <th class="p-2 text-right">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($sale->items as $item)

                            <tr class="border-b">

                                <td class="p-2">
                                    {{ $item->product->name }}
                                </td>

                                <td class="p-2 text-center">
                                    {{ $item->quantity }}
                                </td>

                                <td class="p-2 text-right">
                                    ₹{{ number_format($item->unit_price, 2) }}
                                </td>

                                <td class="p-2 text-right">
                                    ₹{{ number_format($item->total_price, 2) }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <!-- Grand Total -->
                <div class="text-right text-xl font-bold">

                    Total:
                    ₹{{ number_format($sale->total_amount, 2) }}

                </div>

                <!-- Actions -->
                <div class="mt-6 flex justify-end gap-3">

                    <a
                        href="{{ route('sales.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md"
                    >
                        Back
                    </a>

                    <a
                        href="{{ route('sales.invoice', $sale->id) }}"
                        target="_blank"
                        class="px-4 py-2 bg-green-600 text-white rounded-md"
                    >
                        Print Invoice
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>