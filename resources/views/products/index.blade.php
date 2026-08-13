@extends('layouts.app')

@section('header_title', 'Products')

@section('content')

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">

        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Products

                <span class="text-sm text-gray-400 font-normal">
                    ({{ $products->total() }} total)
                </span>
            </h2>
        </div>

        <a
            href="{{ route('products.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition"
        >
            + Add Product
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-5 p-3 rounded-md bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif


    {{-- Search & Filters --}}
    <form
        method="GET"
        action="{{ route('products.index') }}"
        class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6"
    >

        {{-- Search --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search name, SKU, barcode..."
            class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
        >


        {{-- Category --}}
        <select
            name="category_id"
            class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
        >
            <option value="">All Categories</option>

            @foreach($categories as $cat)
                <option
                    value="{{ $cat->id }}"
                    {{ request('category_id') == $cat->id ? 'selected' : '' }}
                >
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>


        {{-- Brand --}}
        {{-- <select
            name="brand_id"
            class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
        >
            <option value="">All Brands</option>

            @foreach($brands as $brand)
                <option
                    value="{{ $brand->id }}"
                    {{ request('brand_id') == $brand->id ? 'selected' : '' }}
                >
                    {{ $brand->name }}
                </option>
            @endforeach
        </select> --}}


        {{-- Status --}}
        <select
            name="status"
            class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"
        >
            <option value="">All Statuses</option>

            <option
                value="In Stock"
                {{ request('status') == 'In Stock' ? 'selected' : '' }}
            >
                In Stock
            </option>

            <option
                value="Low Stock"
                {{ request('status') == 'Low Stock' ? 'selected' : '' }}
            >
                Low Stock
            </option>

            <option
                value="Out of Stock"
                {{ request('status') == 'Out of Stock' ? 'selected' : '' }}
            >
                Out of Stock
            </option>
        </select>


        {{-- Buttons --}}
        <div class="md:col-span-4 flex justify-end space-x-2">

            <a
                href="{{ route('products.index') }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded text-sm transition"
            >
                Clear
            </a>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition"
            >
                Filter
            </button>

        </div>

    </form>


    {{-- Products Table --}}
    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Image
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Product
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Category
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Brand
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Price
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Stock
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Status
                    </th>

                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody class="bg-white divide-y divide-gray-200">

                @forelse($products as $product)

                    <tr class="hover:bg-gray-50">

                        {{-- Image --}}
                        <td class="px-4 py-3">

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="h-10 w-10 object-cover rounded"
                                >

                            @else

                                <div class="h-10 w-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">
                                    —
                                </div>

                            @endif

                        </td>


                        {{-- Product --}}
                        <td class="px-4 py-3">

                            <div class="text-sm font-semibold text-gray-900">
                                {{ $product->name }}
                            </div>

                            @if($product->product_code)
                                <div class="text-xs text-gray-500">
                                    Code: {{ $product->product_code }}
                                </div>
                            @endif

                            @if($product->sku)
                                <div class="text-xs text-gray-400">
                                    SKU: {{ $product->sku }}
                                </div>
                            @endif

                            @if($product->barcode)
                                <div class="text-xs text-gray-400">
                                    Barcode: {{ $product->barcode }}
                                </div>
                            @endif

                        </td>


                        {{-- Category --}}
                        <td class="px-4 py-3 text-sm text-gray-600">

                            {{ $product->category?->name ?? 'No Category' }}

                        </td>


                        {{-- Brand --}}
                        <td class="px-4 py-3 text-sm text-gray-600">

                            {{ $product->brand?->name ?? 'No Brand' }}

                        </td>


                        {{-- Price --}}
                        <td class="px-4 py-3 text-sm text-gray-900">

                            ₹{{ number_format((float) $product->price, 2) }}

                        </td>


                        {{-- Stock --}}
                        <td class="px-4 py-3 text-sm text-gray-900">

                            {{ $product->stock_quantity }}

                        </td>


                        {{-- Status --}}
                        <td class="px-4 py-3">

                            @php
                                $status = $product->status;
                            @endphp

                            @if($status === 'In Stock')

                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    In Stock
                                </span>

                            @elseif($status === 'Low Stock')

                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Low Stock
                                </span>

                            @else

                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Out of Stock
                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="px-4 py-3 text-right text-sm whitespace-nowrap">

                            <a
                                href="{{ route('products.show', $product) }}"
                                class="text-indigo-600 hover:underline mr-2"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('products.edit', $product) }}"
                                class="text-yellow-600 hover:underline mr-2"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('products.destroy', $product) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-red-600 hover:underline"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-4 py-8 text-center text-gray-400"
                        >
                            No products found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-4">

        {{ $products->withQueryString()->links() }}

    </div>

</div>

@endsection