
@extends('layouts.app')

@section('header_title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Overview of your inventory, sales and purchases.
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm text-sm text-gray-600">
            <span>📅</span>
            <span>{{ now()->format('d M Y') }}</span>
        </div>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- LOW STOCK --}}
        <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Low Stock Items
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ number_format($lowStockCount) }}
                    </h2>

                    <p class="mt-2 text-xs text-red-600 font-medium">
                        Requires attention
                    </p>

                </div>

                {{-- <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl group-hover:bg-red-600 group-hover:text-white transition">
                    ⚠
                </div> --}}

            </div>

        </div>


        {{-- SALES --}}
        <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Total Sales
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        ₹{{ number_format($salesData->sum('total'), 2) }}
                    </h2>

                    <p class="mt-2 text-xs text-blue-600 font-medium">
                        Selected period
                    </p>

                </div>

                {{-- <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition">
                    💰
                </div> --}}

            </div>

        </div>


        {{-- PURCHASES --}}
        <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Total Purchases
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        ₹{{ number_format($purchasesData->sum('total'), 2) }}
                    </h2>

                    <p class="mt-2 text-xs text-green-600 font-medium">
                        Selected period
                    </p>

                </div>

                {{-- <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl group-hover:bg-green-600 group-hover:text-white transition">
                    🛒
                </div> --}}

            </div>

        </div>


        {{-- CATEGORIES --}}
        <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-gray-500">
                        Product Categories
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ number_format($categoryData->count()) }}
                    </h2>

                    <p class="mt-2 text-xs text-purple-600 font-medium">
                        Active categories
                    </p>

                </div>

                {{-- <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition">
                    📂
                </div> --}}

            </div>

        </div>

    </div>


    {{-- =========================================================
        CHARTS
    ========================================================== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- SALES / PURCHASES --}}
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900">
                            Sales & Purchases
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Monthly financial performance
                        </p>

                    </div>

                    <span class="w-fit px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-200 text-xs font-medium text-gray-600">
                        Overview
                    </span>

                </div>

            </div>

            <div class="p-6">

                <div class="relative h-80">

                    <canvas id="salesPurchasesChart"></canvas>

                </div>

            </div>

        </div>


        {{-- CATEGORY --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h3 class="text-lg font-bold text-gray-900">
                    Category Distribution
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Products by category
                </p>

            </div>

            <div class="p-6">

                <div class="relative h-80">

                    <canvas id="categoryChart"></canvas>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        RECENT SALES
    ========================================================== --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>

                    <h3 class="text-lg font-bold text-gray-900">
                        Recent Sales
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Latest sales transactions
                    </p>

                </div>

                <a
                    href="{{ route('sales.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition"
                >
                    View All
                    <span>→</span>
                </a>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Invoice
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Customer
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Date
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Amount
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($recentSales as $sale)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- INVOICE --}}
                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('sales.show', $sale->id) }}"
                                    class="inline-flex items-center gap-2 font-semibold text-indigo-600 hover:text-indigo-800 hover:underline"
                                >

                                    <span class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-xs">
                                        🧾
                                    </span>

                                    {{ $sale->invoice_number }}

                                </a>

                            </td>


                            {{-- CUSTOMER --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-sm font-bold text-gray-600">

                                        {{ strtoupper(
                                            substr(
                                                $sale->customer->name ?? 'W',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div>

                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $sale->customer->name ?? 'Walk-in Customer' }}
                                        </p>

                                        <p class="text-xs text-gray-400">
                                            Customer
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- DATE --}}
                            <td class="px-6 py-4">

                                <span class="text-sm text-gray-600">
                                    {{ $sale->sale_date }}
                                </span>

                            </td>


                            {{-- AMOUNT --}}
                            <td class="px-6 py-4 text-right">

                                <span class="font-bold text-gray-900">
                                    ₹{{ number_format($sale->total_amount, 2) }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6 py-12 text-center"
                            >

                                <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-2xl">
                                    🧾
                                </div>

                                <p class="mt-4 font-semibold text-gray-700">
                                    No recent sales
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Sales transactions will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =============================================================
    CHART.JS
============================================================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       SALES & PURCHASES CHART
    ========================================================== */

    const salesCanvas =
        document.getElementById('salesPurchasesChart');

    if (salesCanvas) {

        new Chart(
            salesCanvas.getContext('2d'),
            {

                type: 'bar',

                data: {

                    labels: @json(
                        $salesData->pluck('label')->values()
                    ),

                    datasets: [

                        {
                            label: 'Sales',

                            data: @json(
                                $salesData
                                    ->pluck('total')
                                    ->map(fn ($value) => (float) $value)
                                    ->values()
                            ),

                            backgroundColor:
                                'rgba(79, 70, 229, 0.80)',

                            borderColor:
                                '#4f46e5',

                            borderWidth: 1,

                            borderRadius: 6,

                            borderSkipped: false

                        },

                        {
                            label: 'Purchases',

                            data: @json(
                                $purchasesData
                                    ->pluck('total')
                                    ->map(fn ($value) => (float) $value)
                                    ->values()
                            ),

                            backgroundColor:
                                'rgba(16, 185, 129, 0.75)',

                            borderColor:
                                '#10b981',

                            borderWidth: 1,

                            borderRadius: 6,

                            borderSkipped: false

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

                            position: 'top',

                            align: 'end',

                            labels: {

                                usePointStyle: true,

                                boxWidth: 8,

                                padding: 20

                            }

                        },

                        tooltip: {

                            backgroundColor: '#111827',

                            titleColor: '#ffffff',

                            bodyColor: '#ffffff',

                            padding: 12,

                            cornerRadius: 8,

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

                        x: {

                            grid: {
                                display: false
                            },

                            ticks: {
                                color: '#6b7280'
                            }

                        },

                        y: {

                            beginAtZero: true,

                            grid: {
                                color: '#f3f4f6'
                            },

                            ticks: {

                                color: '#6b7280',

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


    /* =========================================================
       CATEGORY CHART
    ========================================================== */

    const categoryCanvas =
        document.getElementById('categoryChart');

    if (categoryCanvas) {

        new Chart(
            categoryCanvas.getContext('2d'),
            {

                type: 'doughnut',

                data: {

                    labels: @json(
                        $categoryData->pluck('name')->values()
                    ),

                    datasets: [

                        {

                            data: @json(
                                $categoryData
                                    ->pluck('products_count')
                                    ->map(fn ($value) => (int) $value)
                                    ->values()
                            ),

                            backgroundColor: [

                                '#4f46e5',
                                '#10b981',
                                '#f59e0b',
                                '#ef4444',
                                '#8b5cf6',
                                '#06b6d4',
                                '#f97316',
                                '#64748b'

                            ],

                            borderWidth: 3,

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

                                usePointStyle: true,

                                boxWidth: 8,

                                padding: 15,

                                font: {
                                    size: 12
                                }

                            }

                        },

                        tooltip: {

                            backgroundColor: '#111827',

                            padding: 12,

                            cornerRadius: 8

                        }

                    }

                }

            }
        );

    }

});

</script>

@endsection

