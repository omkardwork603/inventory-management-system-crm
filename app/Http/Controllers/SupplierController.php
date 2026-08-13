<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(20);

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        // Generate supplier code
        $supplierCode = 'SUP-' . strtoupper(
            \Illuminate\Support\Str::random(6)
        );

        return view(
            'suppliers.create',
            compact('supplierCode')
        );
    }

    /**
     * Store supplier.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_code' => [
                'required',
                'string',
                'max:50',
                'unique:suppliers,supplier_code',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:50',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:suppliers,email',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier created successfully.'
            );
    }

    /**
     * Show edit form.
     */
    public function edit(Supplier $supplier)
    {
        return view(
            'suppliers.edit',
            compact('supplier')
        );
    }

    /**
     * Update supplier.
     */
    public function update(
        Request $request,
        Supplier $supplier
    ) {
        $validated = $request->validate([
            'supplier_code' => [
                'required',
                'string',
                'max:50',
                'unique:suppliers,supplier_code,' . $supplier->id,
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:50',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:suppliers,email,' . $supplier->id,
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier updated successfully.'
            );
    }

    /**
     * Delete supplier.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with(
                'success',
                'Supplier deleted successfully.'
            );
    }
}