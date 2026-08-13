<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated User Routes (Staff + Admin)
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resources
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class);

    // Purchases & Sales (Exclude edit/update/destroy to preserve stock movement history)
    // Route::resource('purchases', PurchaseController::class)->except(['edit', 'update', 'destroy']);

    Route::resource('purchases', PurchaseController::class)
        ->only([
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
        ]);

    // Route::resource('sales', SaleController::class)->except(['edit', 'update', 'destroy']);
    // Route::get('sales/{sale}/invoice', [SaleController::class, 'invoice'])->name('sales.invoice');

    Route::get('/sales', [
        SaleController::class,
        'index'
    ])->name('sales.index');

    Route::get('/sales/create', [
        SaleController::class,
        'create'
    ])->name('sales.create');

    Route::post('/sales', [
        SaleController::class,
        'store'
    ])->name('sales.store');

    Route::get('/sales/{id}', [
        SaleController::class,
        'show'
    ])->name('sales.show');

    Route::get('/sales/{id}/invoice', [
        SaleController::class,
        'invoice'
    ])->name('sales.invoice');


    // Inventory & Reporting
   Route::get('/stock', [StockController::class, 'index'])
        ->name('stock.index');

    Route::get('/stock/create', [StockController::class, 'create'])
        ->name('stock.create');

    Route::post('/stock', [StockController::class, 'store'])
        ->name('stock.store');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Admin-Only Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

});

require __DIR__.'/auth.php';