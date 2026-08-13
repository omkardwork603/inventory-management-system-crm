<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">

            <h2 class="font-semibold text-xl text-gray-800">
                Sales
            </h2>

            <a
                href="{{ route('sales.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-center"
            >
                + New Sale
            </a>

        </div>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif

            {{-- Error Message --}}
            @if($errors->any())

                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="bg-white p-6 shadow-sm rounded-lg">

                {{-- Filters --}}
                <form
                    action="{{ route('sales.index') }}"
                    method="GET"
                    class="mb-6"
                >

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div>

                            <label class="block text-sm font-semibold mb-1">
                                Invoice Number
                            </label>

                            <input
                                type="text"
                                name="invoice_number"
                                value="{{ request('invoice_number') }}"
                                placeholder="Search invoice..."
                                class="w-full border-gray-300 rounded-md"
                            >

                        </div>

                        <div>

                            <label class="block text-sm font-semibold mb-1">
                                Customer
                            </label>

                            <select
                                name="customer_id"
                                class="w-full border-gray-300 rounded-md"
                            >

                                <option value="">
                                    All Customers
                                </option>

                                @foreach($customers as $customer)

                                    <option
                                        value="{{ $customer->id }}"
                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}
                                    >
                                        {{ $customer->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-semibold mb-1">
                                Sale Date
                            </label>

                            <input
                                type="date"
                                name="date"
                                value="{{ request('date') }}"
                                class="w-full border-gray-300 rounded-md"
                            >

                        </div>

                        <div class="flex items-end gap-2">

                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md"
                            >
                                Search
                            </button>

                            <a
                                href="{{ route('sales.index') }}"
                                class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md"
                            >
                                Reset
                            </a>

                        </div>

                    </div>

                </form>

                {{-- Sales Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-left border-collapse">

                        <thead>

                            <tr class="border-b bg-gray-50">

                                <th class="p-3">
                                    #
                                </th>

                                <th class="p-3">
                                    Invoice #
                                </th>

                                <th class="p-3">
                                    Customer
                                </th>

                                <th class="p-3">
                                    Date
                                </th>

                                <th class="p-3 text-right">
                                    Total
                                </th>

                                <th class="p-3 text-right">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($sales as $sale)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="p-3 text-gray-500">
                                        {{ $sales->firstItem() + $loop->index }}
                                    </td>

                                    <td class="p-3 font-semibold">
                                        {{ $sale->invoice_number }}
                                    </td>

                                    <td class="p-3">
                                        {{ $sale->customer->name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $sale->sale_date->format('d-m-Y') }}
                                    </td>

                                    <td class="p-3 text-right font-bold">
                                        ₹{{ number_format($sale->total_amount, 2) }}
                                    </td>

                                    <td class="p-3 text-right whitespace-nowrap">

                                        <a
                                            href="{{ route('sales.show', $sale->id) }}"
                                            class="text-blue-600 hover:underline mr-3"
                                        >
                                            View
                                        </a>

                                        <a
                                        href="{{ route('sales.invoice', $sale->id) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-green-600 hover:underline"
                                    >
                                        PDF Invoice
                                    </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="p-8 text-center text-gray-500"
                                    >
                                        No sales transactions found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-6">

                    {{ $sales->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>