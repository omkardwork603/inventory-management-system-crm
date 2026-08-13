<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Inventory Management Overview
                </p>
            </div>

            <div class="text-sm text-gray-500">
                {{ now()->format('d M Y') }}
            </div>

        </div>
    </x-slot>


    {{-- MAIN CONTENT --}}
    <div class="py-8 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- WELCOME --}}
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    Welcome back 👋
                </h1>

                <p class="text-gray-500 mt-1">
                    Here's what's happening with your inventory today.
                </p>

            </div>


            {{-- STATISTICS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">


                {{-- TOTAL PRODUCTS --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Products
                            </p>

                            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ number_format($totalProducts) }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                {{ number_format($totalStock) }} units in stock
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                            📦
                        </div>

                    </div>

                </div>


                {{-- MONTHLY SALES --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                This Month Sales
                            </p>

                            <h3 class="text-3xl font-bold text-green-600 mt-2">
                                ₹{{ number_format($monthlySales, 2) }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                Current month revenue
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                            💰
                        </div>

                    </div>

                </div>


                {{-- PROFIT --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Estimated Profit
                            </p>

                            <h3 class="text-3xl font-bold
                                {{ $monthlyProfit >= 0 ? 'text-indigo-600' : 'text-red-600' }}">

                                ₹{{ number_format($monthlyProfit, 2) }}

                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                Sales - Purchases
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl">
                            📈
                        </div>

                    </div>

                </div>


                {{-- LOW STOCK --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Low Stock
                            </p>

                            <h3 class="text-3xl font-bold text-yellow-600 mt-2">
                                {{ $lowStockCount }}
                            </h3>

                            <p class="text-xs text-red-500 mt-2">
                                {{ $outOfStockCount }} out of stock
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">
                            ⚠️
                        </div>

                    </div>

                </div>

            </div>


            {{-- CHARTS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">


                {{-- SALES / PURCHASE CHART --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Sales & Purchases
                        </h3>

                        <p class="text-sm text-gray-500">
                            Last 6 months performance
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="salesPurchaseChart"></canvas>

                    </div>

                </div>


                {{-- CATEGORY CHART --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Product Categories
                        </h3>

                        <p class="text-sm text-gray-500">
                            Products by category
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="categoryChart"></canvas>

                    </div>

                </div>

            </div>


            {{-- LOW STOCK + RECENT SALES --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                {{-- LOW STOCK PRODUCTS --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="p-5 border-b border-gray-200">

                        <div class="flex justify-between items-center">

                            <div>

                                <h3 class="text-lg font-bold text-gray-800">
                                    Low Stock Products
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Products requiring attention
                                </p>

                            </div>

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                                {{ $lowStockCount }}
                            </span>

                        </div>

                    </div>


                    @forelse($lowStockProducts as $product)

                        <div class="flex items-center justify-between p-4 border-b border-gray-100">

                            <div>

                                <p class="font-semibold text-gray-800">
                                    {{ $product->name }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Minimum:
                                    {{ $product->minimum_stock }}
                                </p>

                            </div>


                            <div class="text-right">

                                <p class="font-bold
                                    {{ $product->stock_quantity <= 0
                                        ? 'text-red-600'
                                        : 'text-yellow-600' }}">

                                    {{ $product->stock_quantity }}

                                </p>

                                <p class="text-xs text-gray-500">
                                    available
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="p-8 text-center">

                            <div class="text-4xl mb-2">
                                ✅
                            </div>

                            <p class="text-gray-500">
                                All products have sufficient stock.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- RECENT SALES --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="p-5 border-b border-gray-200">

                        <div class="flex justify-between items-center">

                            <div>

                                <h3 class="text-lg font-bold text-gray-800">
                                    Recent Sales
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Latest transactions
                                </p>

                            </div>

                            <a
                                href="{{ route('sales.index') }}"
                                class="text-sm text-blue-600 hover:text-blue-800 font-semibold"
                            >
                                View All
                            </a>

                        </div>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Invoice
                                    </th>

                                    <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                        Customer
                                    </th>

                                    <th class="p-3 text-right text-xs font-semibold text-gray-500 uppercase">
                                        Amount
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @forelse($recentSales as $sale)

                                    <tr class="hover:bg-gray-50">

                                        <td class="p-3">

                                            <a
                                                href="{{ route('sales.show', $sale->id) }}"
                                                class="font-semibold text-blue-600 hover:underline"
                                            >
                                                {{ $sale->invoice_number }}
                                            </a>

                                        </td>


                                        <td class="p-3 text-sm text-gray-700">

                                            {{ $sale->customer->name ?? 'Walk-in Customer' }}

                                        </td>


                                        <td class="p-3 text-right font-semibold text-gray-800">

                                            ₹{{ number_format($sale->total_amount, 2) }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="3"
                                            class="p-8 text-center text-gray-500"
                                        >
                                            No sales transactions found.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | SALES & PURCHASE DATA
            |--------------------------------------------------------------------------
            */

            const monthLabels = @json(
                $salesData->pluck('label')->values()
            );


            const salesValues = @json(
                $salesData
                    ->pluck('total')
                    ->map(fn ($value) => (float) $value)
                    ->values()
            );


            const purchaseValues = @json(
                $purchasesData
                    ->pluck('total')
                    ->map(fn ($value) => (float) $value)
                    ->values()
            );


            /*
            |--------------------------------------------------------------------------
            | SALES & PURCHASE CHART
            |--------------------------------------------------------------------------
            */

            const salesPurchaseCanvas =
                document.getElementById('salesPurchaseChart');


            if (salesPurchaseCanvas) {

                new Chart(salesPurchaseCanvas, {

                    type: 'line',

                    data: {

                        labels: monthLabels,

                        datasets: [

                            {
                                label: 'Sales',

                                data: salesValues,

                                borderColor: '#16a34a',

                                backgroundColor:
                                    'rgba(22, 163, 74, 0.10)',

                                borderWidth: 3,

                                fill: true,

                                tension: 0.35,

                                pointRadius: 4,

                                pointHoverRadius: 7
                            },


                            {
                                label: 'Purchases',

                                data: purchaseValues,

                                borderColor: '#f97316',

                                backgroundColor:
                                    'rgba(249, 115, 22, 0.08)',

                                borderWidth: 3,

                                fill: true,

                                tension: 0.35,

                                pointRadius: 4,

                                pointHoverRadius: 7
                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,


                        interaction: {

                            mode: 'index',

                            intersect: false

                        },


                        plugins: {

                            legend: {

                                position: 'top'

                            },


                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        return context.dataset.label
                                            + ': ₹'
                                            + Number(context.raw)
                                                .toLocaleString(
                                                    'en-IN',
                                                    {
                                                        minimumFractionDigits: 2
                                                    }
                                                );

                                    }

                                }

                            }

                        },


                        scales: {

                            y: {

                                beginAtZero: true,

                                ticks: {

                                    callback: function (value) {

                                        return '₹'
                                            + Number(value)
                                                .toLocaleString('en-IN');

                                    }

                                }

                            }

                        }

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | CATEGORY DATA
            |--------------------------------------------------------------------------
            */

            const categoryLabels = @json(
                $categoryData->pluck('name')->values()
            );


            const categoryCounts = @json(
                $categoryData
                    ->pluck('products_count')
                    ->map(fn ($value) => (int) $value)
                    ->values()
            );


            /*
            |--------------------------------------------------------------------------
            | CATEGORY CHART
            |--------------------------------------------------------------------------
            */

            const categoryCanvas =
                document.getElementById('categoryChart');


            if (categoryCanvas) {

                new Chart(categoryCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: categoryLabels,

                        datasets: [

                            {
                                label: 'Products',

                                data: categoryCounts,

                                backgroundColor: [
                                    '#2563eb',
                                    '#16a34a',
                                    '#f59e0b',
                                    '#ef4444',
                                    '#8b5cf6',
                                    '#06b6d4',
                                    '#ec4899',
                                    '#64748b'
                                ],

                                borderWidth: 2,

                                borderColor: '#ffffff'
                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '65%',


                        plugins: {

                            legend: {

                                position: 'bottom',

                                labels: {

                                    padding: 15,

                                    usePointStyle: true

                                }

                            }

                        }

                    }

                });

            }

        });

    </script>

</x-app-layout>