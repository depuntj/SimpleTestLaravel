<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts for a customer.
     */
    public function index(Customer $customer): View
    {
        $contacts = $customer->contacts()->paginate(10);

        return view('contacts.index', compact('customer', 'contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create(Customer $customer): View
    {
        return view('contacts.create', compact('customer'));
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $customer->contacts()->create($validated);

        return redirect()->route('customers.contacts.index', $customer->id)
                        ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified contact.
     */
    public function show(Customer $customer, Contact $contact): View
    {
        return view('contacts.show', compact('customer', 'contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Customer $customer, Contact $contact): View
    {
        return view('contacts.edit', compact('customer', 'contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, Customer $customer, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact->update($validated);

        return redirect()->route('customers.contacts.index', $customer->id)
                        ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(Customer $customer, Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('customers.contacts.index', $customer->id)
                        ->with('success', 'Contact deleted successfully.');
    }
}
