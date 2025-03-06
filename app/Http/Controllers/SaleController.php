<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales.
     */
    public function index(Request $request): View
    {
        $customers = Customer::orderBy('name')->get();
        $customerId = $request->input('customer_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $salesQuery = Sale::with('customer')
            ->when($customerId, function ($query, $customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->when($startDate, function ($query, $startDate) {
                return $query->where('sale_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->where('sale_date', '<=', $endDate);
            })
            ->orderBy('sale_date', 'desc');

        $sales = $salesQuery->paginate(10);

        return view('sales.index', compact('sales', 'customers', 'customerId', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create(): View
    {
        $customers = Customer::orderBy('name')->get();
        return view('sales.create', compact('customers'));
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Sale::create($validated);

        return redirect()->route('sales.index')
                        ->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified sale.
     */
    public function show(Sale $sale): View
    {
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified sale.
     */
    public function edit(Sale $sale): View
    {
        $customers = Customer::orderBy('name')->get();
        return view('sales.edit', compact('sale', 'customers'));
    }

    /**
     * Update the specified sale in storage.
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $sale->update($validated);

        return redirect()->route('sales.index')
                        ->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified sale from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->delete();

        return redirect()->route('sales.index')
                        ->with('success', 'Sale deleted successfully.');
    }

    /**
     * Display sales report.
     */
    public function report(Request $request): View
    {
        $customers = Customer::orderBy('name')->get();
        $customerId = $request->input('customer_id');
        $startDate = $request->input('start_date', now()->subMonths(3)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $salesQuery = Sale::with('customer')
            ->when($customerId, function ($query, $customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->whereBetween('sale_date', [$startDate, $endDate]);

        $summary = [
            'total_sales' => $salesQuery->count(),
            'total_quantity' => $salesQuery->sum('quantity'),
            'total_revenue' => $salesQuery->sum('total_price'),
        ];

        $monthlySales = $salesQuery->select(
                DB::raw("TO_CHAR(sale_date, 'YYYY-MM') as month"),
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(total_price) as total_revenue'),
                DB::raw('COUNT(*) as sale_count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $customerSales = [];
        if (!$customerId) {
            $customerSales = Sale::whereBetween('sale_date', [$startDate, $endDate])
                ->select(
                    'customer_id',
                    DB::raw('SUM(quantity) as total_quantity'),
                    DB::raw('SUM(total_price) as total_revenue'),
                    DB::raw('COUNT(*) as sale_count')
                )
                ->groupBy('customer_id')
                ->with('customer')
                ->get();
        }

        return view('sales.report', compact(
            'customers',
            'customerId',
            'startDate',
            'endDate',
            'summary',
            'monthlySales',
            'customerSales'
        ));
    }
}
