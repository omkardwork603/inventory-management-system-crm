<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%");

                if (Schema::hasColumn('products', 'product_code')) {
                    $q->orWhere(
                        'product_code',
                        'like',
                        "%{$search}%"
                    );
                }

                if (Schema::hasColumn('products', 'sku')) {
                    $q->orWhere(
                        'sku',
                        'like',
                        "%{$search}%"
                    );
                }
            });
        }

        // Category Filter
        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        // Brand Filter
        if ($request->filled('brand_id')) {
            $query->where(
                'brand_id',
                $request->brand_id
            );
        }

        // Stock Status Filter
        if ($request->filled('status')) {
            $status = $request->status;

            if ($status === 'Out of Stock') {
                $query->where(
                    'stock_quantity',
                    '<=',
                    0
                );
            } elseif ($status === 'Low Stock') {
                $query->where('stock_quantity', '>', 0)
                    ->whereColumn(
                        'stock_quantity',
                        '<=',
                        'minimum_stock'
                    );
            } elseif ($status === 'In Stock') {
                $query->whereColumn(
                    'stock_quantity',
                    '>',
                    'minimum_stock'
                );
            }
        }

        $products = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = Category::all();
        $brands = Brand::all();

        return view(
            'products.index',
            compact(
                'products',
                'categories',
                'brands'
            )
        );
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view(
            'products.create',
            compact('categories', 'brands')
        );
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'product_code' =>
                'nullable|string|max:255|unique:products,product_code',

            'sku' =>
                'nullable|string|max:255|unique:products,sku',

            'barcode' =>
                'nullable|string|max:255',

            'category_id' =>
                'required|exists:categories,id',

            'brand_id' =>
                'nullable|exists:brands,id',

            // IMPORTANT:
            // These match the products table.
            'price' =>
                'required|numeric|min:0',

            'cost_price' =>
                'required|numeric|min:0',

            'stock_quantity' =>
                'required|integer|min:0',

            'minimum_stock' =>
                'required|integer|min:0',

            'description' =>
                'nullable|string',

            'image' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Auto-generate SKU if empty
        if (
            Schema::hasColumn('products', 'sku')
            && empty($validated['sku'])
        ) {
            $validated['sku'] =
                'SKU-' . strtoupper(Str::random(8));
        }

        // Auto-generate product code if empty
        if (
            Schema::hasColumn('products', 'product_code')
            && empty($validated['product_code'])
        ) {
            $validated['product_code'] =
                'PROD-' . strtoupper(Str::random(8));
        }

        // Upload image
        if ($request->hasFile('image')) {
            $validated['image'] =
                $request->file('image')
                    ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product created successfully.'
            );
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view(
            'products.edit',
            compact(
                'product',
                'categories',
                'brands'
            )
        );
    }

    /**
     * Update the specified product.
     */
    public function update(
        Request $request,
        Product $product
    ) {
        $validated = $request->validate([
            'name' =>
                'required|string|max:255',

            'product_code' =>
                'nullable|string|max:255|unique:products,product_code,' .
                $product->id,

            'sku' =>
                'nullable|string|max:255|unique:products,sku,' .
                $product->id,

            'barcode' =>
                'nullable|string|max:255',

            'category_id' =>
                'required|exists:categories,id',

            'brand_id' =>
                'nullable|exists:brands,id',

            // IMPORTANT:
            // Match database column names.
            'price' =>
                'required|numeric|min:0',

            'cost_price' =>
                'required|numeric|min:0',

            'stock_quantity' =>
                'required|integer|min:0',

            'minimum_stock' =>
                'required|integer|min:0',

            'description' =>
                'nullable|string',

            'image' =>
                'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Replace old image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')
                    ->delete($product->image);
            }

            $validated['image'] =
                $request->file('image')
                    ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'brand'
        ]);

        return view(
            'products.show',
            compact('product')
        );
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete product image
        if ($product->image) {
            Storage::disk('public')
                ->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}