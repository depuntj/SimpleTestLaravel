<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Contact Details</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('customers.contacts.index', $customer->id) }}" class="btn btn-secondary">Back to Contacts</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">{{ $contact->name }}</h5>
                <h6 class="card-subtitle text-muted">Contact for {{ $customer->name }}</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Email:</div>
                    <div class="col-md-10">{{ $contact->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Phone:</div>
                    <div class="col-md-10">{{ $contact->phone }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Created:</div>
                    <div class="col-md-10">{{ $contact->created_at->format('d M Y H:i') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Last Updated:</div>
                    <div class="col-md-10">{{ $contact->updated_at->format('d M Y H:i') }}</div>
                </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <a href="{{ route('customers.contacts.edit', [$customer->id, $contact->id]) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('customers.contacts.destroy', [$customer->id, $contact->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact?');">
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
