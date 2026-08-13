<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Create Purchase
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

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">

                {{-- Validation Errors --}}
                @if ($errors->any())

                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-md">

                        <p class="font-semibold mb-2">
                            Please fix the following errors:
                        </p>

                        <ul class="list-disc list-inside text-sm">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('purchases.store') }}"
                    id="purchaseForm"
                >

                    @csrf


                    {{-- Purchase Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                        {{-- Purchase Number --}}
                        <div>

                            <label
                                for="purchase_number"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Purchase Number *
                            </label>

                            <input
                                type="text"
                                name="purchase_number"
                                id="purchase_number"
                                value="{{ old('purchase_number', 'PUR-' . strtoupper(uniqid())) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required
                            >

                            @error('purchase_number')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Supplier --}}
                        <div>

                            <label
                                for="supplier_id"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Supplier *
                            </label>

                            <select
                                name="supplier_id"
                                id="supplier_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required
                            >

                                <option value="">
                                    Select Supplier
                                </option>

                                @foreach ($suppliers as $supplier)

                                    <option
                                        value="{{ $supplier->id }}"
                                        @selected(old('supplier_id') == $supplier->id)
                                    >
                                        {{ $supplier->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('supplier_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Purchase Date --}}
                        <div>

                            <label
                                for="purchase_date"
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Purchase Date *
                            </label>

                            <input
                                type="date"
                                name="purchase_date"
                                id="purchase_date"
                                value="{{ old('purchase_date', date('Y-m-d')) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required
                            >

                            @error('purchase_date')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Products Section --}}
                    <div class="mb-6">

                        <div class="flex justify-between items-center mb-4">

                            <h3 class="text-lg font-semibold text-gray-800">
                                Purchase Items
                            </h3>

                            <button
                                type="button"
                                id="addItem"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
                            >
                                + Add Product
                            </button>

                        </div>


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

                                        <th class="p-3 text-center">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody id="itemsContainer">

                                    {{-- First Item --}}
                                    <tr class="item-row border-b">

                                        <td class="p-3">

                                            <select
                                                name="items[0][product_id]"
                                                class="product-select w-full border-gray-300 rounded-md"
                                                required
                                            >

                                                <option value="">
                                                    Select Product
                                                </option>

                                                @foreach ($products as $product)

                                                    <option
                                                        value="{{ $product->id }}"
                                                        data-price="{{ $product->purchase_price ?? 0 }}"
                                                    >
                                                        {{ $product->name }}
                                                        — Stock: {{ $product->stock_quantity ?? 0 }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="p-3">

                                            <input
                                                type="number"
                                                name="items[0][quantity]"
                                                class="quantity-input w-full border-gray-300 rounded-md text-center"
                                                value="1"
                                                min="1"
                                                required
                                            >

                                        </td>


                                        <td class="p-3">

                                            <input
                                                type="number"
                                                name="items[0][unit_price]"
                                                class="price-input w-full border-gray-300 rounded-md text-right"
                                                value="0"
                                                min="0"
                                                step="0.01"
                                                required
                                            >

                                        </td>


                                        <td class="p-3 text-right">

                                            <span class="row-total font-semibold">
                                                ₹0.00
                                            </span>

                                        </td>


                                        <td class="p-3 text-center">

                                            <button
                                                type="button"
                                                class="remove-item text-red-600 hover:text-red-800"
                                            >
                                                Remove
                                            </button>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- Grand Total --}}
                    <div class="flex justify-end border-t pt-6">

                        <div class="w-full md:w-96">

                            <div class="flex justify-between items-center">

                                <span class="text-lg font-semibold">
                                    Total Amount:
                                </span>

                                <span
                                    id="grandTotal"
                                    class="text-2xl font-bold text-blue-600"
                                >
                                    ₹0.00
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 mt-8">

                        <a
                            href="{{ route('purchases.index') }}"
                            class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md"
                        >
                            Save Purchase
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- JavaScript --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('itemsContainer');
            const addItemButton = document.getElementById('addItem');
            const grandTotal = document.getElementById('grandTotal');

            let itemIndex = 1;


            /*
             * Calculate row total
             */
            function calculateRow(row) {

                const quantityInput =
                    row.querySelector('.quantity-input');

                const priceInput =
                    row.querySelector('.price-input');

                const rowTotal =
                    row.querySelector('.row-total');

                const quantity =
                    parseFloat(quantityInput.value) || 0;

                const price =
                    parseFloat(priceInput.value) || 0;

                const total =
                    quantity * price;

                rowTotal.textContent =
                    '₹' + total.toFixed(2);

                return total;
            }


            /*
             * Calculate grand total
             */
            function calculateGrandTotal() {

                let total = 0;

                document
                    .querySelectorAll('.item-row')
                    .forEach(function (row) {

                        total += calculateRow(row);

                    });

                grandTotal.textContent =
                    '₹' + total.toFixed(2);
            }


            /*
             * Set product purchase price
             */
            function setProductPrice(row) {

                const select =
                    row.querySelector('.product-select');

                const priceInput =
                    row.querySelector('.price-input');

                const selectedOption =
                    select.options[select.selectedIndex];

                if (!selectedOption) {
                    return;
                }

                const price =
                    selectedOption.dataset.price || 0;

                priceInput.value = price;

                calculateGrandTotal();
            }


            /*
             * Product changed
             */
            container.addEventListener('change', function (event) {

                if (
                    event.target.classList.contains(
                        'product-select'
                    )
                ) {

                    const row =
                        event.target.closest('.item-row');

                    setProductPrice(row);

                }

            });


            /*
             * Quantity / price changed
             */
            container.addEventListener('input', function (event) {

                if (
                    event.target.classList.contains('quantity-input') ||
                    event.target.classList.contains('price-input')
                ) {

                    calculateGrandTotal();

                }

            });


            /*
             * Remove item
             */
            container.addEventListener('click', function (event) {

                if (
                    event.target.classList.contains(
                        'remove-item'
                    )
                ) {

                    const rows =
                        document.querySelectorAll('.item-row');

                    /*
                     * Always keep at least one row
                     */
                    if (rows.length <= 1) {

                        alert(
                            'At least one product is required.'
                        );

                        return;
                    }

                    event.target
                        .closest('.item-row')
                        .remove();

                    calculateGrandTotal();

                }

            });


            /*
             * Add product
             */
            addItemButton.addEventListener('click', function () {

                const row =
                    document.createElement('tr');

                row.className =
                    'item-row border-b';

                row.innerHTML = `

                    <td class="p-3">

                        <select
                            name="items[${itemIndex}][product_id]"
                            class="product-select w-full border-gray-300 rounded-md"
                            required
                        >

                            <option value="">
                                Select Product
                            </option>

                            @foreach ($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    data-price="{{ $product->purchase_price ?? 0 }}"
                                >
                                    {{ $product->name }}
                                    — Stock: {{ $product->stock_quantity ?? 0 }}
                                </option>

                            @endforeach

                        </select>

                    </td>


                    <td class="p-3">

                        <input
                            type="number"
                            name="items[${itemIndex}][quantity]"
                            class="quantity-input w-full border-gray-300 rounded-md text-center"
                            value="1"
                            min="1"
                            required
                        >

                    </td>


                    <td class="p-3">

                        <input
                            type="number"
                            name="items[${itemIndex}][unit_price]"
                            class="price-input w-full border-gray-300 rounded-md text-right"
                            value="0"
                            min="0"
                            step="0.01"
                            required
                        >

                    </td>


                    <td class="p-3 text-right">

                        <span class="row-total font-semibold">
                            ₹0.00
                        </span>

                    </td>


                    <td class="p-3 text-center">

                        <button
                            type="button"
                            class="remove-item text-red-600 hover:text-red-800"
                        >
                            Remove
                        </button>

                    </td>

                `;

                container.appendChild(row);

                itemIndex++;

                calculateGrandTotal();

            });


            /*
             * Initial calculation
             */
            calculateGrandTotal();

        });

    </script>

</x-app-layout>