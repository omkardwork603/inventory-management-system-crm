<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display customers.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(20);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $customerCode = $this->generateCustomerCode();

        return view(
            'customers.create',
            compact('customerCode')
        );
    }

    /**
     * Generate unique customer code.
     */
    private function generateCustomerCode(): string
    {
        do {
            $code = 'CUST-' . strtoupper(Str::random(6));
        } while (Customer::where('customer_code', $code)->exists());

        return $code;
    }

    /**
     * Store customer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_code' => [
                'required',
                'string',
                'max:50',
                'unique:customers,customer_code',
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
                'unique:customers,email',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Customer $customer)
    {
        return view(
            'customers.edit',
            compact('customer')
        );
    }

    /**
     * Update customer.
     */
    public function update(
        Request $request,
        Customer $customer
    ) {
        $validated = $request->validate([
            'customer_code' => [
                'required',
                'string',
                'max:50',
                'unique:customers,customer_code,' . $customer->id,
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
                'unique:customers,email,' . $customer->id,
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Delete customer.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}