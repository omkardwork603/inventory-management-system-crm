<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display sales list.
     */
    public function index(Request $request)
    {
        $query = Sale::with('customer');

        if ($request->filled('date')) {
            $query->whereDate(
                'sale_date',
                $request->date
            );
        }

        if ($request->filled('customer_id')) {
            $query->where(
                'customer_id',
                $request->customer_id
            );
        }

        if ($request->filled('invoice_number')) {
            $query->where(
                'invoice_number',
                'like',
                '%' . $request->invoice_number . '%'
            );
        }

        $sales = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $customers = Customer::orderBy('name')->get();

        return view(
            'sales.index',
            compact('sales', 'customers')
        );
    }

    /**
     * Show create sale form.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        $products = Product::where(
            'stock_quantity',
            '>',
            0
        )
        ->orderBy('name')
        ->get();

        return view(
            'sales.create',
            compact('customers', 'products')
        );
    }

    /**
     * Store a new sale.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => [
                'required',
                'string',
                'max:255',
                'unique:sales,invoice_number',
            ],

            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'sale_date' => [
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

        try {

            DB::transaction(function () use ($request) {

                $totalAmount = 0;

                /*
                |--------------------------------------------------------------------------
                | Check stock and calculate total
                |--------------------------------------------------------------------------
                */

                foreach ($request->items as $item) {

                    $product = Product::where(
                        'id',
                        $item['product_id']
                    )
                    ->lockForUpdate()
                    ->firstOrFail();

                    if (
                        $product->stock_quantity
                        < $item['quantity']
                    ) {

                        throw new \Exception(
                            "Insufficient stock for {$product->name}. " .
                            "Available stock: {$product->stock_quantity}"
                        );
                    }

                    $itemTotal =
                        (float) $item['quantity']
                        * (float) $item['unit_price'];

                    $totalAmount += $itemTotal;
                }

                /*
                |--------------------------------------------------------------------------
                | Create Sale
                |--------------------------------------------------------------------------
                */

                $sale = Sale::create([
                    'invoice_number' => $request->invoice_number,
                    'customer_id' => $request->customer_id,
                    'sale_date' => $request->sale_date,
                    'total_amount' => $totalAmount,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Create Sale Items + Deduct Stock
                |--------------------------------------------------------------------------
                */

                foreach ($request->items as $item) {

                    $product = Product::where(
                        'id',
                        $item['product_id']
                    )
                    ->lockForUpdate()
                    ->firstOrFail();

                    $itemTotal =
                        (float) $item['quantity']
                        * (float) $item['unit_price'];

                    /*
                    |--------------------------------------------------------------------------
                    | Create Sale Item
                    |--------------------------------------------------------------------------
                    */

                    $sale->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'total_price' => $itemTotal,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Deduct Product Stock
                    |--------------------------------------------------------------------------
                    */

                    $product->decrement(
                        'stock_quantity',
                        $item['quantity']
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Create Stock Movement
                    |--------------------------------------------------------------------------
                    */

                    StockMovement::create([
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'type' => 'OUT',
                        'reference' =>
                            'Sale Invoice #' .
                            $sale->invoice_number,
                        'user_id' => Auth::id(),
                    ]);
                }
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'sale' => $e->getMessage()
                ]);
        }

        return redirect()
            ->route('sales.index')
            ->with(
                'success',
                'Sale created successfully.'
            );
    }

    /**
     * Display sale details.
     */
    public function show($id)
    {
        $sale = Sale::with([
            'customer',
            'items.product'
        ])->findOrFail($id);

        return view(
            'sales.show',
            compact('sale')
        );
    }

    /**
     * Generate and download PDF invoice.
     */
    public function invoice($id)
    {
        $sale = Sale::with([
            'customer',
            'items.product'
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'sales.invoice',
            compact('sale')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'invoice-' .
            $sale->invoice_number .
            '.pdf'
        );
    }
}