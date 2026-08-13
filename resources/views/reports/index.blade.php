<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

            <div>

                <h2 class="font-bold text-2xl text-gray-800">
                    Reports & Analytics
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Inventory, sales and purchase performance
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-8 bg-gray-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="mb-5 rounded-lg bg-green-100 border border-green-200 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>

            @endif


            {{-- VALIDATION ERRORS --}}

            @if($errors->any())

                <div class="mb-5 rounded-lg bg-red-100 border border-red-200 text-red-700 px-4 py-3">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- DATE FILTER --}}

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">

                <form
                    action="{{ route('reports.index') }}"
                    method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end"
                >

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ $startDate }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            End Date
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            value="{{ $endDate }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- <div>

                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg transition"
                        >
                            Generate Report
                        </button>

                    </div> --}}


                    <div>

                        <a
                            href="{{ route('reports.index') }}"
                            class="block text-center w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- PERIOD --}}

            <div class="mb-5">

                <p class="text-sm text-gray-500">

                    Report period:

                    <span class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                    </span>

                    -

                    <span class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                    </span>

                </p>

            </div>


            {{-- STATISTICS --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">


                {{-- REVENUE --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 font-medium">
                                Total Revenue
                            </p>

                            <h3 class="text-2xl font-bold text-gray-900 mt-2">
                                ₹{{ number_format($totalSales, 2) }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                {{ $salesCount }} transactions
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                            ₹
                        </div>

                    </div>

                </div>


                {{-- PURCHASES --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 font-medium">
                                Total Purchases
                            </p>

                            <h3 class="text-2xl font-bold text-gray-900 mt-2">
                                ₹{{ number_format($totalPurchases, 2) }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                {{ $purchaseCount }} transactions
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-xl">
                            📦
                        </div>

                    </div>

                </div>


                {{-- PROFIT --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 font-medium">
                                Estimated Profit
                            </p>

                            <h3 class="text-2xl font-bold
                                {{ $estimatedProfit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                ₹{{ number_format($estimatedProfit, 2) }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                Revenue - Purchases
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                            {{ $estimatedProfit >= 0 ? 'bg-green-100' : 'bg-red-100' }}
                            flex items-center justify-center text-xl">
                            📈
                        </div>

                    </div>

                </div>


                {{-- PRODUCTS --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 font-medium">
                                Total Products
                            </p>

                            <h3 class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $totalProducts }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-2">
                                {{ number_format($totalStock) }} units
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                            🏷️
                        </div>

                    </div>

                </div>

            </div>


            {{-- CHART ROW 1 --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">


                {{-- SALES VS PURCHASES --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Sales vs Purchases
                        </h3>

                        <p class="text-sm text-gray-500">
                            Daily financial performance
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="salesPurchaseChart"></canvas>

                    </div>

                </div>


                {{-- SALES TREND --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Sales Trend
                        </h3>

                        <p class="text-sm text-gray-500">
                            Revenue over selected period
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="salesTrendChart"></canvas>

                    </div>

                </div>

            </div>


            {{-- CHART ROW 2 --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">


                {{-- TOP PRODUCTS --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Top Selling Products
                        </h3>

                        <p class="text-sm text-gray-500">
                            Units sold during selected period
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="topProductsChart"></canvas>

                    </div>

                </div>


                {{-- INVENTORY STATUS --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-800">
                            Inventory Status
                        </h3>

                        <p class="text-sm text-gray-500">
                            Current inventory condition
                        </p>

                    </div>

                    <div class="relative h-80">

                        <canvas id="inventoryChart"></canvas>

                    </div>

                </div>

            </div>


            {{-- LOW STOCK + RECENT SALES --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                {{-- LOW STOCK --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="p-5 border-b">

                        <div class="flex justify-between items-center">

                            <div>

                                <h3 class="font-bold text-gray-800">
                                    Low Stock Alerts
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


                    @forelse($lowStockProducts->take(5) as $product)

                        <div class="p-4 border-b flex justify-between items-center">

                            <div>

                                <p class="font-semibold text-gray-800">
                                    {{ $product->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Minimum stock:
                                    {{ $product->minimum_stock }}
                                </p>

                            </div>

                            <div class="text-right">

                                <p class="font-bold text-yellow-600">
                                    {{ $product->stock_quantity }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    available
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="p-8 text-center text-gray-500">
                            No low-stock products.
                        </div>

                    @endforelse

                </div>


                {{-- RECENT SALES --}}

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="p-5 border-b">

                        <h3 class="font-bold text-gray-800">
                            Recent Sales
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Latest sales transactions
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="p-3 text-left text-xs text-gray-500 uppercase">
                                        Invoice
                                    </th>

                                    <th class="p-3 text-left text-xs text-gray-500 uppercase">
                                        Customer
                                    </th>

                                    <th class="p-3 text-right text-xs text-gray-500 uppercase">
                                        Amount
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y">

                                @forelse($recentSales as $sale)

                                    <tr class="hover:bg-gray-50">

                                        <td class="p-3 font-semibold text-blue-600">
                                            {{ $sale->invoice_number }}
                                        </td>

                                        <td class="p-3 text-sm">
                                            {{ $sale->customer->name ?? 'Walk-in Customer' }}
                                        </td>

                                        <td class="p-3 text-right font-semibold">
                                            ₹{{ number_format($sale->total_amount, 2) }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="3"
                                            class="p-6 text-center text-gray-500"
                                        >
                                            No sales found.
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
            | Chart Data From Laravel
            |--------------------------------------------------------------------------
            */

            const chartLabels = @json($chartLabels);

            const salesData = @json($salesChartData);

            const purchasesData = @json($purchasesChartData);


            const productLabels = @json(
                $topProducts->pluck('name')->values()
            );

            const productQuantities = @json(
                $topProducts->pluck('total_quantity')->map(
                    fn ($value) => (int) $value
                )->values()
            );


            /*
            |--------------------------------------------------------------------------
            | Sales vs Purchases
            |--------------------------------------------------------------------------
            */

            const salesPurchaseElement =
                document.getElementById('salesPurchaseChart');

            if (salesPurchaseElement) {

                new Chart(
                    salesPurchaseElement,
                    {
                        type: 'bar',

                        data: {

                            labels: chartLabels,

                            datasets: [

                                {
                                    label: 'Sales',

                                    data: salesData,

                                    backgroundColor: '#22c55e',

                                    borderRadius: 6,

                                    maxBarThickness: 35
                                },

                                {
                                    label: 'Purchases',

                                    data: purchasesData,

                                    backgroundColor: '#f97316',

                                    borderRadius: 6,

                                    maxBarThickness: 35
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

                                            return context.dataset.label +
                                                ': ₹' +
                                                Number(context.raw)
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

                                            return '₹' +
                                                Number(value)
                                                    .toLocaleString('en-IN');

                                        }

                                    }

                                }

                            }

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Sales Trend
            |--------------------------------------------------------------------------
            */

            const salesTrendElement =
                document.getElementById('salesTrendChart');

            if (salesTrendElement) {

                new Chart(
                    salesTrendElement,
                    {
                        type: 'line',

                        data: {

                            labels: chartLabels,

                            datasets: [

                                {
                                    label: 'Sales Revenue',

                                    data: salesData,

                                    borderColor: '#2563eb',

                                    backgroundColor:
                                        'rgba(37, 99, 235, 0.10)',

                                    fill: true,

                                    tension: 0.35,

                                    borderWidth: 2,

                                    pointRadius: 3,

                                    pointHoverRadius: 6
                                }

                            ]

                        },

                        options: {

                            responsive: true,

                            maintainAspectRatio: false,

                            plugins: {

                                legend: {
                                    display: false
                                }

                            },

                            scales: {

                                y: {

                                    beginAtZero: true,

                                    ticks: {

                                        callback: function (value) {

                                            return '₹' +
                                                Number(value)
                                                    .toLocaleString('en-IN');

                                        }

                                    }

                                }

                            }

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Top Products
            |--------------------------------------------------------------------------
            */

            const topProductsElement =
                document.getElementById('topProductsChart');

            if (topProductsElement) {

                new Chart(
                    topProductsElement,
                    {
                        type: 'bar',

                        data: {

                            labels: productLabels,

                            datasets: [

                                {
                                    label: 'Units Sold',

                                    data: productQuantities,

                                    backgroundColor: '#6366f1',

                                    borderRadius: 6,

                                    maxBarThickness: 35
                                }

                            ]

                        },

                        options: {

                            indexAxis: 'y',

                            responsive: true,

                            maintainAspectRatio: false,

                            plugins: {

                                legend: {
                                    display: false
                                }

                            },

                            scales: {

                                x: {

                                    beginAtZero: true,

                                    ticks: {
                                        precision: 0
                                    }

                                }

                            }

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Inventory Status
            |--------------------------------------------------------------------------
            */

            const inventoryElement =
                document.getElementById('inventoryChart');


            const healthyStock = Math.max(
                0,
                {{ $totalProducts }}
                - {{ $lowStockCount }}
                - {{ $outOfStockCount }}
            );


            if (inventoryElement) {

                new Chart(
                    inventoryElement,
                    {
                        type: 'doughnut',

                        data: {

                            labels: [
                                'Healthy Stock',
                                'Low Stock',
                                'Out of Stock'
                            ],

                            datasets: [

                                {
                                    data: [
                                        healthyStock,
                                        {{ $lowStockCount }},
                                        {{ $outOfStockCount }}
                                    ],

                                    backgroundColor: [
                                        '#22c55e',
                                        '#f59e0b',
                                        '#ef4444'
                                    ],

                                    borderWidth: 0
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
                                        padding: 20
                                    }

                                }

                            }

                        }

                    }
                );

            }

        });

    </script>

</x-app-layout>