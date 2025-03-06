<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('customers.index', compact('customers', 'search'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'location' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer): View
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'location' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index')
                        ->with('success', 'Customer deleted successfully.');
    }
    
    /**
     * Display customers grouped by location or category.
     */
    public function group(Request $request): View
    {
        $groupBy = $request->input('group_by', 'location');
        $validGroupBy = in_array($groupBy, ['location', 'category']) ? $groupBy : 'location';

        $customers = Customer::whereNotNull($validGroupBy)
                         ->orderBy($validGroupBy)
                         ->orderBy('name')
                         ->get();

        $groupedCustomers = $customers->groupBy($validGroupBy);

        return view('customers.group', compact('groupedCustomers', 'groupBy'));
    }
}
