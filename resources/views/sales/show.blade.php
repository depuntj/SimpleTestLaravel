<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Sale Details</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back to Sales</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Sale #{{ $sale->id }}</h5>
                <h6 class="card-subtitle text-muted">Date: {{ $sale->sale_date->format('d M Y') }}</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Customer:</div>
                    <div class="col-md-9">
                        <a href="{{ route('customers.show', $sale->customer_id) }}">
                            {{ $sale->customer->name }}
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Quantity:</div>
                    <div class="col-md-9">{{ $sale->quantity }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Total Price:</div>
                    <div class="col-md-9">${{ number_format($sale->total_price, 2) }}</div>
                </div>
                @if($sale->notes)
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Notes:</div>
                    <div class="col-md-9">{{ $sale->notes }}</div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created:</div>
                    <div class="col-md-9">{{ $sale->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Last Updated:</div>
                    <div class="col-md-9">{{ $sale->updated_at->format('d M Y H:i') }}</div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sale?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
