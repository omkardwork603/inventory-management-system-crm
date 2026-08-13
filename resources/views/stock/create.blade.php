<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800">
            Stock Adjustment
        </h2>

    </x-slot>


    <div class="py-6">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <h2 class="text-xl font-semibold mb-6">
                    Add Stock Movement
                </h2>


                @if($errors->any())

                    <div class="mb-5 p-4 bg-red-100 text-red-700 rounded-md">

                        <ul class="list-disc list-inside">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('stock.store') }}"
                    method="POST"
                    class="space-y-5"
                >

                    @csrf


                    {{-- Product --}}
                    <div>

                        <label
                            for="product_id"
                            class="block font-medium mb-1"
                        >
                            Product *
                        </label>

                        <select
                            name="product_id"
                            id="product_id"
                            class="w-full border-gray-300 rounded-md"
                            required
                        >

                            <option value="">
                                Select Product
                            </option>

                            @foreach($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    @selected(old('product_id') == $product->id)
                                >
                                    {{ $product->name }}
                                    — Stock: {{ $product->stock_quantity }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Type --}}
                    <div>

                        <label
                            for="type"
                            class="block font-medium mb-1"
                        >
                            Movement Type *
                        </label>

                        <select
                            name="type"
                            id="type"
                            class="w-full border-gray-300 rounded-md"
                            required
                        >

                            <option value="">
                                Select Type
                            </option>

                            <option
                                value="in"
                                @selected(old('type') === 'in')
                            >
                                Stock In
                            </option>

                            <option
                                value="out"
                                @selected(old('type') === 'out')
                            >
                                Stock Out
                            </option>

                        </select>

                    </div>


                    {{-- Quantity --}}
                    <div>

                        <label
                            for="quantity"
                            class="block font-medium mb-1"
                        >
                            Quantity *
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            min="1"
                            value="{{ old('quantity') }}"
                            class="w-full border-gray-300 rounded-md"
                            required
                        >

                    </div>


                    {{-- Reference --}}
                    <div>

                        <label
                            for="reference"
                            class="block font-medium mb-1"
                        >
                            Reference
                        </label>

                        <input
                            type="text"
                            name="reference"
                            id="reference"
                            value="{{ old('reference') }}"
                            placeholder="Purchase, sale, adjustment..."
                            class="w-full border-gray-300 rounded-md"
                        >

                    </div>


                    <div class="flex justify-end gap-2">

                        <a
                            href="{{ route('stock.index') }}"
                            class="px-5 py-2 bg-gray-100 rounded-md"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-md"
                        >
                            Save Movement
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>