<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Edit Product: {{ $product->name }}
                </h2>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('products.update', $product->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Product Name --}}
                        <div>
                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Name *
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                required
                            >

                            @error('name')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Product Code --}}
                        <div>
                            <label
                                for="product_code"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Code
                            </label>

                            <input
                                type="text"
                                id="product_code"
                                name="product_code"
                                value="{{ old('product_code', $product->product_code) }}"
                                placeholder="Auto-generated if empty"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('product_code') border-red-500 @enderror"
                            >

                            @error('product_code')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- SKU --}}
                        <div>
                            <label
                                for="sku"
                                class="block text-sm font-medium text-gray-700"
                            >
                                SKU
                            </label>

                            <input
                                type="text"
                                id="sku"
                                name="sku"
                                value="{{ old('sku', $product->sku) }}"
                                placeholder="Auto-generated if empty"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('sku') border-red-500 @enderror"
                            >

                            @error('sku')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Barcode --}}
                        <div>
                            <label
                                for="barcode"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Barcode
                            </label>

                            <input
                                type="text"
                                id="barcode"
                                name="barcode"
                                value="{{ old('barcode', $product->barcode) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('barcode') border-red-500 @enderror"
                            >

                            @error('barcode')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            <label
                                for="category_id"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Category *
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror"
                                required
                            >
                                <option value="">Select Category</option>

                                @foreach ($categories as $cat)
                                    <option
                                        value="{{ $cat->id }}"
                                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}
                                    >
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Cost Price --}}
                        <div>
                            <label
                                for="cost_price"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Cost Price (₹) *
                            </label>

                            <input
                                type="number"
                                id="cost_price"
                                name="cost_price"
                                step="0.01"
                                min="0"
                                value="{{ old('cost_price', $product->cost_price) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('cost_price') border-red-500 @enderror"
                                required
                            >

                            @error('cost_price')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Selling Price --}}
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Selling Price (₹) *
                            </label>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                step="0.01"
                                min="0"
                                value="{{ old('price', $product->price) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror"
                                required
                            >

                            @error('price')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Current Stock --}}
                        <div>
                            <label
                                for="stock_quantity"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Current Stock Quantity *
                            </label>

                            <input
                                type="number"
                                id="stock_quantity"
                                name="stock_quantity"
                                min="0"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('stock_quantity') border-red-500 @enderror"
                                required
                            >

                            @error('stock_quantity')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Minimum Stock --}}
                        <div>
                            <label
                                for="minimum_stock"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Minimum Stock Alert Threshold *
                            </label>

                            <input
                                type="number"
                                id="minimum_stock"
                                name="minimum_stock"
                                min="0"
                                value="{{ old('minimum_stock', $product->minimum_stock) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('minimum_stock') border-red-500 @enderror"
                                required
                            >

                            @error('minimum_stock')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Product Image --}}
                        <div class="md:col-span-2">
                            <label
                                for="image"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Product Image
                            </label>

                            @if ($product->image)
                                <div class="mt-2 mb-3 flex items-center space-x-4">
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-16 w-16 object-cover rounded-md border border-gray-200"
                                    >
                                    <span class="text-xs text-gray-500">Current Image</span>
                                </div>
                            @endif

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                class="mt-1 w-full text-sm text-gray-600 border border-gray-300 rounded-md p-1"
                            >

                            @error('image')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                            >{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end space-x-3 pt-4">

                        <a
                            href="{{ route('products.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-5 rounded-md text-sm transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-md text-sm transition"
                        >
                            Update Product
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>