<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts for {{ $customer->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Contacts for {{ $customer->name }}</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary me-2">Back to Customer</a>
                <a href="{{ route('customers.contacts.create', $customer->id) }}" class="btn btn-primary">Add New Contact</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                @if(count($contacts) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('customers.contacts.show', [$customer->id, $contact->id]) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('customers.contacts.edit', [$customer->id, $contact->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('customers.contacts.destroy', [$customer->id, $contact->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $contacts->links() }}
                    </div>
                @else
                    <p class="text-center">No contacts found for this customer.</p>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
