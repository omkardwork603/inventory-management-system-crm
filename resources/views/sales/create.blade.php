<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Create Sale
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    {{-- Sale Information --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

                        <div>
                            <label class="block font-bold mb-1">
                                Customer *
                            </label>

                            <select
                                name="customer_id"
                                class="w-full border-gray-300 rounded-md"
                                required
                            >
                                <option value="">Select Customer</option>

                                @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                    >
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold mb-1">
                                Sale Date *
                            </label>

                            <input
                                type="date"
                                name="sale_date"
                                value="{{ old('sale_date', date('Y-m-d')) }}"
                                class="w-full border-gray-300 rounded-md"
                                required
                            >
                        </div>

                        <div>
                            <label class="block font-bold mb-1">
                                Invoice Number
                            </label>

                            <input
                                type="text"
                                name="invoice_number"
                                value="{{ old('invoice_number', 'INV-' . time()) }}"
                                class="w-full border-gray-300 rounded-md bg-gray-100"
                                readonly
                            >
                        </div>

                    </div>

                    {{-- Products --}}
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-bold text-lg">
                            Item Details
                        </h3>

                        <button
                            type="button"
                            id="addItem"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md"
                        >
                            + Add Item
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
                                        Available
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

                                            @foreach($products as $product)

                                                <option
                                                    value="{{ $product->id }}"
                                                    data-stock="{{ $product->stock_quantity }}"
                                                >
                                                    {{ $product->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </td>

                                    <td class="p-3 text-center">

                                        <span class="stock-display text-gray-600">
                                            -
                                        </span>

                                    </td>

                                    <td class="p-3">

                                        <input
                                            type="number"
                                            name="items[0][quantity]"
                                            min="1"
                                            value="1"
                                            class="quantity-input w-full border-gray-300 rounded-md text-center"
                                            required
                                        >

                                    </td>

                                    <td class="p-3">

                                        <input
                                            type="number"
                                            name="items[0][unit_price]"
                                            min="0"
                                            step="0.01"
                                            value="0"
                                            class="price-input w-full border-gray-300 rounded-md text-right"
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
                                            class="remove-item text-red-600 hover:text-red-800 font-semibold"
                                        >
                                            Remove
                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    {{-- Grand Total --}}
                    <div class="flex justify-end mt-6">

                        <div class="w-full md:w-80">

                            <div class="flex justify-between border-t pt-4">
                                <span class="text-xl font-bold">
                                    Grand Total:
                                </span>

                                <span
                                    id="grandTotal"
                                    class="text-xl font-bold text-green-600"
                                >
                                    ₹0.00
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 mt-8">

                        <a
                            href="{{ route('sales.index') }}"
                            class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md"
                        >
                            Complete Sale
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    <script>
        let itemIndex = 1;

        const container = document.getElementById('itemsContainer');
        const addItemButton = document.getElementById('addItem');
        const grandTotal = document.getElementById('grandTotal');

        function formatCurrency(value) {
            return '₹' + Number(value).toFixed(2);
        }

        function calculateGrandTotal() {

            let total = 0;

            document.querySelectorAll('.item-row').forEach(row => {

                const quantity =
                    parseFloat(
                        row.querySelector('.quantity-input')?.value
                    ) || 0;

                const price =
                    parseFloat(
                        row.querySelector('.price-input')?.value
                    ) || 0;

                const rowTotal = quantity * price;

                const totalElement =
                    row.querySelector('.row-total');

                if (totalElement) {
                    totalElement.textContent =
                        formatCurrency(rowTotal);
                }

                total += rowTotal;
            });

            grandTotal.textContent =
                formatCurrency(total);
        }

        function updateStock(row) {

            const select =
                row.querySelector('.product-select');

            const stockDisplay =
                row.querySelector('.stock-display');

            if (!select || !stockDisplay) {
                return;
            }

            const selectedOption =
                select.options[select.selectedIndex];

            if (
                selectedOption &&
                selectedOption.dataset.stock
            ) {
                stockDisplay.textContent =
                    selectedOption.dataset.stock;
            } else {
                stockDisplay.textContent = '-';
            }
        }

        function setupRow(row) {

            const select =
                row.querySelector('.product-select');

            const quantity =
                row.querySelector('.quantity-input');

            const price =
                row.querySelector('.price-input');

            const removeButton =
                row.querySelector('.remove-item');

            select.addEventListener('change', function () {
                updateStock(row);
            });

            quantity.addEventListener(
                'input',
                calculateGrandTotal
            );

            price.addEventListener(
                'input',
                calculateGrandTotal
            );

            removeButton.addEventListener(
                'click',
                function () {

                    const rows =
                        document.querySelectorAll('.item-row');

                    if (rows.length > 1) {
                        row.remove();
                        calculateGrandTotal();
                    } else {
                        alert('At least one product is required.');
                    }

                }
            );
        }

        setupRow(
            document.querySelector('.item-row')
        );

        addItemButton.addEventListener(
            'click',
            function () {

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

                            @foreach($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    data-stock="{{ $product->stock_quantity }}"
                                >
                                    {{ $product->name }}
                                </option>

                            @endforeach

                        </select>

                    </td>

                    <td class="p-3 text-center">

                        <span class="stock-display text-gray-600">
                            -
                        </span>

                    </td>

                    <td class="p-3">

                        <input
                            type="number"
                            name="items[${itemIndex}][quantity]"
                            min="1"
                            value="1"
                            class="quantity-input w-full border-gray-300 rounded-md text-center"
                            required
                        >

                    </td>

                    <td class="p-3">

                        <input
                            type="number"
                            name="items[${itemIndex}][unit_price]"
                            min="0"
                            step="0.01"
                            value="0"
                            class="price-input w-full border-gray-300 rounded-md text-right"
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
                            class="remove-item text-red-600 hover:text-red-800 font-semibold"
                        >
                            Remove
                        </button>

                    </td>

                `;

                container.appendChild(row);

                setupRow(row);

                itemIndex++;

            }
        );

    </script>

</x-app-layout>