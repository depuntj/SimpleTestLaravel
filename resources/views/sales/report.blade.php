<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Sales Report</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary me-2">Back to Sales</a>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Customers</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <form action="{{ route('sales.report') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-select">
                            <option value="">All Customers</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customerId == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Generate Report</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <h4 class="mb-4">
                    Sales Report
                    @if($customerId)
                        for {{ $customers->find($customerId)->name }}
                    @else
                        for All Customers
                    @endif
                    ({{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }})
                </h4>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Sales</h5>
                                <h2 class="card-text">{{ $summary['total_sales'] }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Quantity</h5>
                                <h2 class="card-text">{{ $summary['total_quantity'] }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Revenue</h5>
                                <h2 class="card-text">${{ number_format($summary['total_revenue'], 2) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($monthlySales) > 0)
                    <h5 class="mb-3">Monthly Breakdown</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Number of Sales</th>
                                    <th>Quantity Sold</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlySales as $month)
                                    <tr>
                                        <td>{{ date('F Y', strtotime($month->month . '-01')) }}</td>
                                        <td>{{ $month->sale_count }}</td>
                                        <td>{{ $month->total_quantity }}</td>
                                        <td>${{ number_format($month->total_revenue, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(!$customerId && count($customerSales) > 0)
                    <h5 class="mb-3">Sales by Customer</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Number of Sales</th>
                                    <th>Quantity Sold</th>
                                    <th>Revenue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerSales as $cs)
                                    <tr>
                                        <td>{{ $cs->customer->name }}</td>
                                        <td>{{ $cs->sale_count }}</td>
                                        <td>{{ $cs->total_quantity }}</td>
                                        <td>${{ number_format($cs->total_revenue, 2) }}</td>
                                        <td>
                                            <a href="{{ route('sales.report', ['customer_id' => $cs->customer_id, 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-sm btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
