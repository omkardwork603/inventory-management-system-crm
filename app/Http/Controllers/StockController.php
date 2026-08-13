<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display stock movements.
     */
    public function index(Request $request)
    {
        $query = StockMovement::with(['product', 'user']);

        // Filter by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by movement type
        if ($request->filled('type')) {
            $query->where('type', strtoupper($request->type));
        }

        $movements = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $products = Product::orderBy('name')->get();

        return view('stock.index', compact(
            'movements',
            'products'
        ));
    }

    /**
     * Show stock movement form.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock.create', compact('products'));
    }

    /**
     * Store stock movement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'type' => [
                'required',
                'in:in,out',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'reference' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            // Lock product so two users cannot update stock
            // at the same time.
            $product = Product::lockForUpdate()
                ->findOrFail($validated['product_id']);

            $quantity = (int) $validated['quantity'];

            /*
            |--------------------------------------------------------------------------
            | STOCK IN
            |--------------------------------------------------------------------------
            */
            if ($validated['type'] === 'in') {

                $product->stock_quantity =
                    (int) $product->stock_quantity + $quantity;

                $product->save();
            }

            /*
            |--------------------------------------------------------------------------
            | STOCK OUT
            |--------------------------------------------------------------------------
            */
            if ($validated['type'] === 'out') {

                if ((int) $product->stock_quantity < $quantity) {
                    throw new \Exception(
                        'Insufficient stock. Available stock: ' .
                        $product->stock_quantity
                    );
                }

                $product->stock_quantity =
                    (int) $product->stock_quantity - $quantity;

                $product->save();
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE STOCK MOVEMENT
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Store IN / OUT consistently in database.
            |
            */
            StockMovement::create([
                'product_id' => $product->id,

                'quantity' => $quantity,

                'type' => strtoupper($validated['type']),

                'reference' => $validated['reference'] ?? null,

                'user_id' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('stock.index')
            ->with(
                'success',
                'Stock ' .
                strtoupper($validated['type']) .
                ' successfully. ' .
                $validated['quantity'] .
                ' units updated.'
            );
    }
}