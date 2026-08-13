<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>

                <h2 class="font-bold text-xl text-gray-800">
                    Stock Movements
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Track all inventory stock in and stock out transactions.
                </p>

            </div>

            <a
                href="{{ route('stock.create') }}"
                class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold"
            >
                + Add Stock Movement
            </a>

        </div>

    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success --}}
            @if(session('success'))

                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">

                    <div class="font-semibold">
                        Success
                    </div>

                    <div class="text-sm mt-1">
                        {{ session('success') }}
                    </div>

                </div>

            @endif

            {{-- Error --}}
            @if(session('error'))

                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">

                    {{ session('error') }}

                </div>

            @endif

            {{-- Filters --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">

                <form
                    method="GET"
                    action="{{ route('stock.index') }}"
                    class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4"
                >

                    {{-- Product --}}
                    <div>

                        <label
                            for="product_id"
                            class="block text-sm font-semibold text-gray-700 mb-2"
                        >
                            Product
                        </label>

                        <select
                            id="product_id"
                            name="product_id"
                            class="w-full rounded-lg border-gray-300"
                        >

                            <option value="">
                                All Products
                            </option>

                            @foreach($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    @selected(request('product_id') == $product->id)
                                >
                                    {{ $product->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Type --}}
                    <div>

                        <label
                            for="type"
                            class="block text-sm font-semibold text-gray-700 mb-2"
                        >
                            Movement Type
                        </label>

                        <select
                            id="type"
                            name="type"
                            class="w-full rounded-lg border-gray-300"
                        >

                            <option value="">
                                All Types
                            </option>

                            <option
                                value="in"
                                @selected(strtolower(request('type')) === 'in')
                            >
                                Stock In
                            </option>

                            <option
                                value="out"
                                @selected(strtolower(request('type')) === 'out')
                            >
                                Stock Out
                            </option>

                        </select>

                    </div>

                    {{-- Filter --}}
                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="px-5 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-lg font-semibold"
                        >
                            Filter
                        </button>

                        <a
                            href="{{ route('stock.index') }}"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class="px-5 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Date
                                </th>

                                <th class="px-5 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Product
                                </th>

                                <th class="px-5 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Type
                                </th>

                                <th class="px-5 py-4 text-right text-xs font-bold text-gray-500 uppercase">
                                    Quantity
                                </th>

                                <th class="px-5 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    Reference
                                </th>

                                <th class="px-5 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                    User
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($movements as $movement)

                                <tr class="hover:bg-gray-50">

                                    {{-- Date --}}
                                    <td class="px-5 py-4 text-sm text-gray-600">

                                        {{ $movement->created_at?->format('d M Y, h:i A') }}

                                    </td>

                                    {{-- Product --}}
                                    <td class="px-5 py-4">

                                        <div class="font-semibold text-gray-800">
                                            {{ $movement->product?->name ?? 'Deleted Product' }}
                                        </div>

                                        @if($movement->product)

                                            <div class="text-xs text-gray-500 mt-1">
                                                Current Stock:
                                                {{ $movement->product->stock_quantity }}
                                            </div>

                                        @endif

                                    </td>

                                    {{-- Type --}}
                                    <td class="px-5 py-4">

                                        @if(strtoupper($movement->type) === 'IN')

                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                ↑ STOCK IN
                                            </span>

                                        @else

                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                ↓ STOCK OUT
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Quantity --}}
                                    <td class="px-5 py-4 text-right">

                                        @if(strtoupper($movement->type) === 'IN')

                                            <span class="font-bold text-green-600">
                                                +{{ number_format($movement->quantity) }}
                                            </span>

                                        @else

                                            <span class="font-bold text-red-600">
                                                -{{ number_format($movement->quantity) }}
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Reference --}}
                                    <td class="px-5 py-4 text-sm text-gray-600">

                                        {{ $movement->reference ?? 'Manual Adjustment' }}

                                    </td>

                                    {{-- User --}}
                                    <td class="px-5 py-4 text-sm text-gray-600">

                                        {{ $movement->user?->name ?? 'System' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-5 py-12 text-center"
                                    >

                                        <div class="text-4xl mb-3">
                                            📦
                                        </div>

                                        <p class="font-semibold text-gray-700">
                                            No stock movements found
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Add your first Stock In or Stock Out movement.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($movements->hasPages())

                    <div class="p-5 border-t border-gray-200">
                        {{ $movements->links() }}
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>