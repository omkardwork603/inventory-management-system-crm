@extends('layouts.app')

@section('header_title', 'Product Details')

@section('content')
<div class="max-w-3xl mx-auto py-6">

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-700 rounded-md text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

        {{-- Top Navigation & Actions Header --}}
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 pb-6 mb-6 border-b border-gray-100">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    {{ $product->name }}
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    @if($product->product_code)
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-mono">
                            {{ $product->product_code }}
                        </span>
                    @endif
                    <span class="text-xs text-gray-400">•</span>
                    <span class="text-xs text-gray-500">
                        Added {{ $product->created_at?->format('M d, Y') ?? 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <a
                    href="{{ route('products.edit', $product) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold py-2 px-4 rounded-md transition shadow-sm"
                >
                    Edit
                </a>

                <a
                    href="{{ route('products.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-4 rounded-md transition"
                >
                    Back
                </a>
            </div>
        </div>

        {{-- Product Details Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Image Preview Column --}}
            <div>
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-64 object-cover rounded-lg border border-gray-200 shadow-sm"
                    >
                @else
                    <div class="w-full h-64 bg-gray-50 rounded-lg border border-dashed border-gray-300 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">No Image Available</span>
                    </div>
                @endif
            </div>

            {{-- Specification Column --}}
            <div class="space-y-4">

                <div class="grid grid-cols-2 gap-4 pb-3 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            SKU
                        </span>
                        <p class="text-sm text-gray-800 font-mono">
                            {{ $product->sku ?: '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Barcode
                        </span>
                        <p class="text-sm text-gray-800 font-mono">
                            {{ $product->barcode ?: '—' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 pb-3 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Category
                        </span>
                        <p class="text-sm text-gray-800 font-medium">
                            {{ $product->category?->name ?? 'Uncategorized' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Brand
                        </span>
                        <p class="text-sm text-gray-800 font-medium">
                            {{ $product->brand?->name ?? 'Unbranded' }}
                        </p>
                    </div>
                </div>

                {{-- Financial Overview --}}
                <div class="grid grid-cols-2 gap-4 p-3 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-0.5">
                            Selling Price
                        </span>
                        <p class="text-lg text-gray-900 font-bold">
                            ₹{{ number_format((float) $product->price, 2) }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-0.5">
                            Cost Price
                        </span>
                        <p class="text-lg text-gray-700 font-semibold">
                            ₹{{ number_format((float) $product->cost_price, 2) }}
                        </p>
                    </div>
                </div>

                {{-- Inventory Overview --}}
                <div class="grid grid-cols-3 gap-3 pt-1">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Current Stock
                        </span>
                        <p class="text-base text-gray-900 font-bold">
                            {{ number_format($product->stock_quantity) }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Min. Threshold
                        </span>
                        <p class="text-base text-gray-700 font-medium">
                            {{ number_format($product->minimum_stock) }}
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-0.5">
                            Stock Status
                        </span>
                        <div class="mt-0.5">
                            @if($product->stock_quantity <= 0)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Out of Stock
                                </span>
                            @elseif($product->stock_quantity <= $product->minimum_stock)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Low Stock
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    In Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Product Description --}}
        @if($product->description)
            <div class="mt-6 pt-4 border-t border-gray-100">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">
                    Description
                </span>
                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                    {{ $product->description }}
                </p>
            </div>
        @endif

        {{-- Danger Zone / Actions Footer --}}
       <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
    {{-- Audit Metadata --}}
    <div class="flex items-center gap-2 text-xs text-gray-500">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Last modified <time class="font-medium text-gray-700">{{ $product->updated_at?->diffForHumans() ?? 'N/A' }}</time></span>
    </div>

    {{-- Danger Action --}}
    <form
        action="{{ route('products.destroy', $product) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')"
        class="w-full sm:w-auto"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 border border-red-200/80 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/20 active:bg-red-200/70"
        >
            <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            <span>Delete Product</span>
        </button>
    </form>
</div>

    </div>
</div>
@endsection