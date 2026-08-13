<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">

            <h2 class="font-semibold text-xl text-gray-800">
                Purchases

                <span class="text-sm text-gray-400 font-normal">
                    ({{ $purchases->total() }})
                </span>
            </h2>

            <a
                href="{{ route('purchases.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
            >
                + New Purchase
            </a>

        </div>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Success Message --}}
            @if(session('success'))

                <div class="mb-5 p-4 bg-green-100 border border-green-200 text-green-700 rounded-md">

                    {{ session('success') }}

                </div>

            @endif


            {{-- Error Message --}}
            @if(session('error'))

                <div class="mb-5 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">

                    {{ session('error') }}

                </div>

            @endif


            {{-- Validation Errors --}}
            @if($errors->any())

                <div class="mb-5 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Filters --}}
            <div class="bg-white p-5 shadow-sm rounded-lg mb-6">

                <form
                    action="{{ route('purchases.index') }}"
                    method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4"
                >


                    {{-- Purchase Number --}}
                    <div>

                        <label
                            for="purchase_number"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Purchase Number
                        </label>

                        <input
                            type="text"
                            name="purchase_number"
                            id="purchase_number"
                            value="{{ request('purchase_number') }}"
                            placeholder="PUR-..."
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- Supplier --}}
                    <div>

                        <label
                            for="supplier_id"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Supplier
                        </label>

                        <select
                            name="supplier_id"
                            id="supplier_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                All Suppliers
                            </option>

                            @foreach($suppliers as $supplier)

                                <option
                                    value="{{ $supplier->id }}"
                                    @selected(request('supplier_id') == $supplier->id)
                                >
                                    {{ $supplier->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Date --}}
                    <div>

                        <label
                            for="date"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Date
                        </label>

                        <input
                            type="date"
                            name="date"
                            id="date"
                            value="{{ request('date') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- Buttons --}}
                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-md"
                        >
                            Filter
                        </button>

                        <a
                            href="{{ route('purchases.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- Purchase Table --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full text-left border-collapse">

                        <thead>

                            <tr class="border-b bg-gray-50">

                                <th class="p-3">
                                    Purchase #
                                </th>

                                <th class="p-3">
                                    Supplier
                                </th>

                                <th class="p-3">
                                    Date
                                </th>

                                <th class="p-3">
                                    Total
                                </th>

                                <th class="p-3 text-right">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($purchases as $purchase)

                                <tr class="border-b hover:bg-gray-50">


                                    {{-- Purchase Number --}}
                                    <td class="p-3 font-semibold">

                                        {{ $purchase->purchase_number }}

                                    </td>


                                    {{-- Supplier --}}
                                    <td class="p-3">

                                        {{ $purchase->supplier?->name ?? 'Deleted Supplier' }}

                                    </td>


                                    {{-- Date --}}
                                    <td class="p-3">

                                        @if($purchase->purchase_date instanceof \Carbon\Carbon)

                                            {{ $purchase->purchase_date->format('Y-m-d') }}

                                        @else

                                            {{ $purchase->purchase_date }}

                                        @endif

                                    </td>


                                    {{-- Total --}}
                                    <td class="p-3 font-bold">

                                        ₹{{ number_format((float) $purchase->total_amount, 2) }}

                                    </td>


                                    {{-- Actions --}}
                                    <td class="p-3">

                                        <div class="flex justify-end items-center gap-3">


                                            {{-- View --}}
                                            <a
                                                href="{{ route('purchases.show', $purchase) }}"
                                                class="text-blue-600 hover:text-blue-800 hover:underline"
                                            >
                                                View
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('purchases.edit', $purchase) }}"
                                                class="text-green-600 hover:text-green-800 hover:underline"
                                            >
                                                Edit
                                            </a>


                                          
                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="p-8 text-center text-gray-500"
                                    >

                                        <div class="flex flex-col items-center">

                                            <span class="text-lg font-medium">
                                                No purchases found
                                            </span>

                                            <span class="text-sm mt-1">
                                                Create your first purchase to see it here.
                                            </span>

                                            <a
                                                href="{{ route('purchases.create') }}"
                                                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
                                            >
                                                + Create Purchase
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($purchases->hasPages())

                    <div class="p-5 border-t">

                        {{ $purchases->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>