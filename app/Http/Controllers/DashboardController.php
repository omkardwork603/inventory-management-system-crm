<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        /*
        |--------------------------------------------------------------------------
        | SUMMARY CARDS
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::whereColumn(
            'stock_quantity',
            '<=',
            'minimum_stock'
        )
            ->orderBy('stock_quantity')
            ->get();

        $lowStockCount = $lowStockProducts->count();

        $outOfStockCount = Product::where(
            'stock_quantity',
            '<=',
            0
        )->count();

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock_quantity');


        /*
        |--------------------------------------------------------------------------
        | CURRENT MONTH SALES
        |--------------------------------------------------------------------------
        */

        $monthlySales = Sale::whereBetween(
            'sale_date',
            [
                $now->copy()->startOfMonth()->toDateString(),
                $now->copy()->endOfMonth()->toDateString(),
            ]
        )->sum('total_amount');


        /*
        |--------------------------------------------------------------------------
        | CURRENT MONTH PURCHASES
        |--------------------------------------------------------------------------
        */

        $monthlyPurchases = Purchase::whereBetween(
            'purchase_date',
            [
                $now->copy()->startOfMonth()->toDateString(),
                $now->copy()->endOfMonth()->toDateString(),
            ]
        )->sum('total_amount');


        /*
        |--------------------------------------------------------------------------
        | PROFIT
        |--------------------------------------------------------------------------
        */

        $monthlyProfit =
            $monthlySales - $monthlyPurchases;


        /*
        |--------------------------------------------------------------------------
        | LAST 6 MONTHS SALES & PURCHASES
        |--------------------------------------------------------------------------
        */

        $salesData = collect();

        $purchasesData = collect();


        for ($i = 5; $i >= 0; $i--) {

            $date = $now->copy()->subMonths($i);

            $start = $date->copy()->startOfMonth();

            $end = $date->copy()->endOfMonth();


            $salesTotal = Sale::whereBetween(
                'sale_date',
                [
                    $start->toDateString(),
                    $end->toDateString(),
                ]
            )->sum('total_amount');


            $purchaseTotal = Purchase::whereBetween(
                'purchase_date',
                [
                    $start->toDateString(),
                    $end->toDateString(),
                ]
            )->sum('total_amount');


            $salesData->push([
                'label' => $date->format('M Y'),
                'total' => (float) $salesTotal,
            ]);


            $purchasesData->push([
                'label' => $date->format('M Y'),
                'total' => (float) $purchaseTotal,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY DISTRIBUTION
        |--------------------------------------------------------------------------
        */

        $categoryData = Category::withCount('products')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RECENT SALES
        |--------------------------------------------------------------------------
        */

        $recentSales = Sale::with('customer')
            ->latest()
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact(
            'lowStockProducts',
            'lowStockCount',
            'outOfStockCount',
            'totalProducts',
            'totalStock',
            'monthlySales',
            'monthlyPurchases',
            'monthlyProfit',
            'salesData',
            'purchasesData',
            'categoryData',
            'recentSales'
        ));
    }
}