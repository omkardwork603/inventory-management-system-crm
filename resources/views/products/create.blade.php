<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Add New Product
                </h2>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-200 text-green-700 rounded-md text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- General Error Message --}}
                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 border border-red-200 text-red-700 rounded-md text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Validation Errors Summary --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                        <p class="font-medium text-sm mb-1">Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('products.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4"
                >
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Product Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Product Code --}}
                        <div>
                            <label for="product_code" class="block text-sm font-medium text-gray-700">
                                Product Code
                            </label>
                            <input
                                type="text"
                                id="product_code"
                                name="product_code"
                                value="{{ old('product_code') }}"
                                placeholder="Auto-generated if left empty"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('product_code') border-red-500 @else border-gray-300 @enderror"
                            >
                            @error('product_code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- SKU --}}
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700">
                                SKU
                            </label>
                            <input
                                type="text"
                                id="sku"
                                name="sku"
                                value="{{ old('sku') }}"
                                placeholder="Auto-generated if left empty"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('sku') border-red-500 @else border-gray-300 @enderror"
                            >
                            @error('sku')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Barcode --}}
                        <div>
                            <label for="barcode" class="block text-sm font-medium text-gray-700">
                                Barcode
                            </label>
                            <input
                                type="text"
                                id="barcode"
                                name="barcode"
                                value="{{ old('barcode') }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('barcode') border-red-500 @else border-gray-300 @enderror"
                            >
                            @error('barcode')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option
                                        value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}
                                    >
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cost Price --}}
                        <div>
                            <label for="cost_price" class="block text-sm font-medium text-gray-700">
                                Cost Price (₹) <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                id="cost_price"
                                name="cost_price"
                                step="0.01"
                                min="0"
                                value="{{ old('cost_price', '0.00') }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('cost_price') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                            @error('cost_price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Selling Price --}}
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Selling Price (₹) <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                step="0.01"
                                min="0"
                                value="{{ old('price', '0.00') }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Initial Stock --}}
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700">
                                Initial Stock Quantity <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                id="stock_quantity"
                                name="stock_quantity"
                                min="0"
                                value="{{ old('stock_quantity', 0) }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('stock_quantity') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                            @error('stock_quantity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Minimum Stock Threshold --}}
                        <div>
                            <label for="minimum_stock" class="block text-sm font-medium text-gray-700">
                                Minimum Stock Alert Threshold <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                id="minimum_stock"
                                name="minimum_stock"
                                min="0"
                                value="{{ old('minimum_stock', 5) }}"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('minimum_stock') border-red-500 @else border-gray-300 @enderror"
                                required
                            >
                            @error('minimum_stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Product Image --}}
                        <div class="md:col-span-2">
    <label for="image" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Product Image
    </label>

    <div class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50/30 transition-all duration-200 group bg-gray-50/50 text-center cursor-pointer">
        {{-- File Input --}}
        <input
            type="file"
            id="image"
            name="image"
            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
        >

        {{-- Upload Icon & Visual Guidance --}}
        <div class="p-3 bg-white rounded-full shadow-sm border border-gray-200 group-hover:border-blue-200 group-hover:scale-110 transition-all duration-200 mb-3">
            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>

        <div class="text-sm text-gray-600">
            <span class="font-semibold text-blue-600 group-hover:text-blue-700">Click to upload</span>
            <span class="text-gray-400">or drag and drop</span>
        </div>

        <p class="text-xs text-gray-400 mt-1">
            PNG, JPG, WEBP, GIF up to 5MB
        </p>
    </div>

    @error('image')
        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>{{ $message }}</span>
        </p>
    @enderror
</div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="mt-1 w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @else border-gray-300 @enderror"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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
                            Save Product
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>