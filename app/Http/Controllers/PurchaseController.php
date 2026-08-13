<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display purchases.
     */
    public function index(Request $request)
    {
        $query = Purchase::with('supplier');

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate(
                'purchase_date',
                $request->date
            );
        }

        // Supplier filter
        if ($request->filled('supplier_id')) {
            $query->where(
                'supplier_id',
                $request->supplier_id
            );
        }

        // Purchase number search
        if ($request->filled('purchase_number')) {
            $query->where(
                'purchase_number',
                'like',
                '%' . $request->purchase_number . '%'
            );
        }

        $purchases = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $suppliers = Supplier::orderBy('name')->get();

        return view(
            'purchases.index',
            compact('purchases', 'suppliers')
        );
    }

    /**
     * Show create purchase form.
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view(
            'purchases.create',
            compact('suppliers', 'products')
        );
    }

    /**
     * Store purchase.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_number' => [
                'required',
                'string',
                'max:100',
                'unique:purchases,purchase_number',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'purchase_date' => [
                'required',
                'date',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'exists:products,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            /*
             * Calculate total
             */
            $totalAmount = 0;

            foreach ($validated['items'] as $item) {
                $totalAmount +=
                    (int) $item['quantity'] *
                    (float) $item['unit_price'];
            }


            /*
             * Create purchase
             */
            $purchase = Purchase::create([
                'purchase_number' => $validated['purchase_number'],
                'supplier_id' => $validated['supplier_id'],
                'purchase_date' => $validated['purchase_date'],
                'total_amount' => $totalAmount,
            ]);


            /*
             * Create purchase items
             * and increase stock
             */
            foreach ($validated['items'] as $item) {

                $quantity = (int) $item['quantity'];

                $unitPrice = (float) $item['unit_price'];

                $totalPrice = $quantity * $unitPrice;


                /*
                 * Purchase item
                 */
                $purchase->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                ]);


                /*
                 * Lock product during stock update
                 */
                $product = Product::lockForUpdate()
                    ->findOrFail($item['product_id']);


                /*
                 * Increase stock
                 */
                $product->increment(
                    'stock_quantity',
                    $quantity
                );


                /*
                 * Stock movement
                 */
                StockMovement::create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'type' => 'IN',
                    'reference' =>
                        'Purchase #' .
                        $purchase->purchase_number,
                    'user_id' => Auth::id(),
                ]);
            }
        });

        return redirect()
            ->route('purchases.index')
            ->with(
                'success',
                'Purchase recorded successfully and stock updated.'
            );
    }

    public function edit(Purchase $purchase)
{
    $purchase->load('items');

    $suppliers = Supplier::orderBy('name')->get();
    $products = Product::orderBy('name')->get();

    return view(
        'purchases.edit',
        compact('purchase', 'suppliers', 'products')
    );
}


public function update(Request $request, Purchase $purchase)
{
    $validated = $request->validate([
        'purchase_number' => [
            'required',
            'string',
            'max:100',
            'unique:purchases,purchase_number,' . $purchase->id,
        ],

        'supplier_id' => [
            'required',
            'exists:suppliers,id',
        ],

        'purchase_date' => [
            'required',
            'date',
        ],

        'items' => [
            'required',
            'array',
            'min:1',
        ],

        'items.*.product_id' => [
            'required',
            'exists:products,id',
        ],

        'items.*.quantity' => [
            'required',
            'integer',
            'min:1',
        ],

        'items.*.unit_price' => [
            'required',
            'numeric',
            'min:0',
        ],
    ]);

    DB::transaction(function () use ($validated, $purchase) {

        /*
         * First reverse old stock
         */
        foreach ($purchase->items as $oldItem) {

            $oldProduct = Product::lockForUpdate()
                ->find($oldItem->product_id);

            if ($oldProduct) {

                $oldProduct->decrement(
                    'stock_quantity',
                    $oldItem->quantity
                );
            }
        }


        /*
         * Delete old purchase items
         */
        $purchase->items()->delete();


        /*
         * Calculate new total
         */
        $totalAmount = 0;

        foreach ($validated['items'] as $item) {

            $totalAmount +=
                (int) $item['quantity'] *
                (float) $item['unit_price'];
        }


        /*
         * Update purchase
         */
        $purchase->update([
            'purchase_number' => $validated['purchase_number'],
            'supplier_id' => $validated['supplier_id'],
            'purchase_date' => $validated['purchase_date'],
            'total_amount' => $totalAmount,
        ]);


        /*
         * Create new items and update stock
         */
        foreach ($validated['items'] as $item) {

            $quantity = (int) $item['quantity'];

            $unitPrice = (float) $item['unit_price'];

            $totalPrice = $quantity * $unitPrice;


            $purchase->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
            ]);


            $product = Product::lockForUpdate()
                ->findOrFail($item['product_id']);


            $product->increment(
                'stock_quantity',
                $quantity
            );


            StockMovement::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'type' => 'IN',
                'reference' =>
                    'Purchase Updated #' .
                    $purchase->purchase_number,
                'user_id' => Auth::id(),
            ]);
        }
    });

    return redirect()
        ->route('purchases.show', $purchase)
        ->with(
            'success',
            'Purchase updated successfully and stock adjusted.'
        );
}

    /**
     * Show purchase details.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'items.product',
        ]);

        return view(
            'purchases.show',
            compact('purchase')
        );
    }
}