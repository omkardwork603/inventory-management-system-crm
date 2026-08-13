<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800">
                Purchase Details
            </h2>

            <a
                href="{{ route('purchases.index') }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md"
            >
                ← Back
            </a>

        </div>

    </x-slot>


    <div class="py-12">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">


                {{-- Header Information --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                    <div>

                        <p class="text-sm text-gray-500">
                            Purchase Number
                        </p>

                        <p class="font-bold text-lg">
                            {{ $purchase->purchase_number }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Supplier
                        </p>

                        <p class="font-semibold">
                            {{ $purchase->supplier?->name ?? 'Deleted Supplier' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Purchase Date
                        </p>

                        <p class="font-semibold">
                            {{ $purchase->purchase_date?->format('Y-m-d') ?? $purchase->purchase_date }}
                        </p>

                    </div>

                </div>


                {{-- Items --}}
                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>

                            <tr class="bg-gray-100 border-b">

                                <th class="p-3 text-left">
                                    Product
                                </th>

                                <th class="p-3 text-center">
                                    Quantity
                                </th>

                                <th class="p-3 text-right">
                                    Unit Price
                                </th>

                                <th class="p-3 text-right">
                                    Total
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($purchase->items as $item)

                                <tr class="border-b">

                                    <td class="p-3">

                                        {{ $item->product?->name ?? 'Deleted Product' }}

                                    </td>


                                    <td class="p-3 text-center">

                                        {{ $item->quantity }}

                                    </td>


                                    <td class="p-3 text-right">

                                        ₹{{ number_format((float) $item->unit_price, 2) }}

                                    </td>


                                    <td class="p-3 text-right font-semibold">

                                        ₹{{ number_format((float) $item->total_price, 2) }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="4"
                                        class="p-6 text-center text-gray-500"
                                    >
                                        No purchase items found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Grand Total --}}
                <div class="border-t mt-6 pt-5 flex justify-end">

                    <div class="text-right">

                        <p class="text-sm text-gray-500">
                            Total Amount
                        </p>

                        <p class="text-2xl font-bold text-blue-600">

                            ₹{{ number_format((float) $purchase->total_amount, 2) }}

                        </p>

                    </div>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>