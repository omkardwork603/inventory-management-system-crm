<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $startDate = $request->input(
            'start_date',
            now()->startOfMonth()->toDateString()
        );

        $endDate = $request->input(
            'end_date',
            now()->toDateString()
        );

        /*
        |--------------------------------------------------------------------------
        | INVENTORY
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock_quantity');

        $outOfStockCount = Product::where(
            'stock_quantity',
            '<=',
            0
        )->count();

        $lowStockProducts = Product::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock_quantity')
            ->get();

        $lowStockCount = $lowStockProducts->count();


        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $salesQuery = Sale::whereBetween(
            'sale_date',
            [$startDate, $endDate]
        );

        $totalSales = $salesQuery->sum('total_amount');

        $salesCount = $salesQuery->count();


        /*
        |--------------------------------------------------------------------------
        | PURCHASES
        |--------------------------------------------------------------------------
        */

        $purchaseQuery = Purchase::whereBetween(
            'purchase_date',
            [$startDate, $endDate]
        );

        $totalPurchases = $purchaseQuery->sum('total_amount');

        $purchaseCount = $purchaseQuery->count();


        /*
        |--------------------------------------------------------------------------
        | PROFIT
        |--------------------------------------------------------------------------
        */

        $estimatedProfit = $totalSales - $totalPurchases;


        /*
        |--------------------------------------------------------------------------
        | RECENT SALES
        |--------------------------------------------------------------------------
        */

        $recentSales = Sale::with('customer')
            ->latest('sale_date')
            ->latest('id')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOP SELLING PRODUCTS
        |--------------------------------------------------------------------------
        */

        $topProducts = DB::table('sale_items')
            ->join(
                'products',
                'sale_items.product_id',
                '=',
                'products.id'
            )
            ->join(
                'sales',
                'sale_items.sale_id',
                '=',
                'sales.id'
            )
            ->whereBetween(
                'sales.sale_date',
                [$startDate, $endDate]
            )
            ->select(
                'products.id',
                'products.name',
                DB::raw(
                    'SUM(sale_items.quantity) as total_quantity'
                ),
                DB::raw(
                    'SUM(sale_items.total_price) as total_revenue'
                )
            )
            ->groupBy(
                'products.id',
                'products.name'
            )
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DAILY SALES
        |--------------------------------------------------------------------------
        */

        $dailySales = Sale::whereBetween(
            'sale_date',
            [$startDate, $endDate]
        )
            ->select(
                'sale_date',
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DAILY PURCHASES
        |--------------------------------------------------------------------------
        */

        $dailyPurchases = Purchase::whereBetween(
            'purchase_date',
            [$startDate, $endDate]
        )
            ->select(
                'purchase_date',
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('purchase_date')
            ->orderBy('purchase_date')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Convert Carbon dates to Y-m-d strings.
        | This prevents:
        |
        | Cannot access offset of type Illuminate\Support\Carbon
        |
        |--------------------------------------------------------------------------
        */

        $salesByDate = $dailySales->mapWithKeys(function ($sale) {

            $date = $sale->sale_date instanceof \Carbon\Carbon
                ? $sale->sale_date->format('Y-m-d')
                : date('Y-m-d', strtotime($sale->sale_date));

            return [
                $date => (float) $sale->total
            ];
        });


        $purchasesByDate = $dailyPurchases->mapWithKeys(function ($purchase) {

            $date = $purchase->purchase_date instanceof \Carbon\Carbon
                ? $purchase->purchase_date->format('Y-m-d')
                : date('Y-m-d', strtotime($purchase->purchase_date));

            return [
                $date => (float) $purchase->total
            ];
        });


        /*
        |--------------------------------------------------------------------------
        | COMBINE ALL DATES
        |--------------------------------------------------------------------------
        */

        $chartDates = collect(
            array_unique(
                array_merge(
                    $salesByDate->keys()->toArray(),
                    $purchasesByDate->keys()->toArray()
                )
            )
        )
            ->sort()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | CHART ARRAYS
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];

        $salesChartData = [];

        $purchasesChartData = [];


        foreach ($chartDates as $date) {

            $chartLabels[] = date(
                'd M',
                strtotime($date)
            );


            $salesChartData[] = $salesByDate->get(
                $date,
                0
            );


            $purchasesChartData[] = $purchasesByDate->get(
                $date,
                0
            );
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.index',
            compact(
                'totalProducts',
                'totalStock',
                'outOfStockCount',

                'lowStockCount',
                'lowStockProducts',

                'totalSales',
                'salesCount',

                'totalPurchases',
                'purchaseCount',

                'estimatedProfit',

                'recentSales',

                'topProducts',

                'dailySales',
                'dailyPurchases',

                'chartLabels',
                'salesChartData',
                'purchasesChartData',

                'startDate',
                'endDate'
            )
        );
    }
}