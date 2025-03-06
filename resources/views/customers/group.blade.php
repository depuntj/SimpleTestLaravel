<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grouped Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Customers by {{ ucfirst($groupBy) }}</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Group customers by:</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group float-end" role="group">
                            <a href="{{ route('customers.group', ['group_by' => 'location']) }}" class="btn btn{{ $groupBy === 'location' ? '-primary' : '-outline-primary' }}">Location</a>
                            <a href="{{ route('customers.group', ['group_by' => 'category']) }}" class="btn btn{{ $groupBy === 'category' ? '-primary' : '-outline-primary' }}">Category</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($groupedCustomers->count() > 0)
                    <div class="accordion" id="customerGroups">
                        @foreach($groupedCustomers as $group => $customers)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                                        {{ $group }} ({{ $customers->count() }} customers)
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#customerGroups">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customers as $customer)
                                                        <tr>
                                                            <td>{{ $customer->name }}</td>
                                                            <td>{{ $customer->email }}</td>
                                                            <td>{{ $customer->phone }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <p>No customers found with {{ $groupBy }} information. Please update customer information to use this feature.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
