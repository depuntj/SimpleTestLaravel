@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Customer Details</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{ $customer->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Email:</div>
                <div class="col-md-10">{{ $customer->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Phone:</div>
                <div class="col-md-10">{{ $customer->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Address:</div>
                <div class="col-md-10">{{ $customer->address }}</div>
            </div>
            @if($customer->location)
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Location:</div>
                <div class="col-md-10">{{ $customer->location }}</div>
            </div>
            @endif
            @if($customer->category)
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Category:</div>
                <div class="col-md-10">{{ $customer->category }}</div>
            </div>
            @endif
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Created:</div>
                <div class="col-md-10">{{ $customer->created_at->format('d M Y H:i') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 fw-bold">Last Updated:</div>
                <div class="col-md-10">{{ $customer->updated_at->format('d M Y H:i') }}</div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group">
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contacts section -->
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Contacts</h2>
            <a href="{{ route('customers.contacts.index', $customer->id) }}" class="btn btn-primary">View All Contacts</a>
        </div>

        <div class="card">
            <div class="card-body">
                @if($customer->contacts->count() > 0)
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
                                @foreach($customer->contacts->take(5) as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('customers.contacts.show', [$customer->id, $contact->id]) }}" class="btn btn-info btn-sm">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($customer->contacts->count() > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('customers.contacts.index', $customer->id) }}" class="btn btn-link">View all {{ $customer->contacts->count() }} contacts</a>
                        </div>
                    @endif
                @else
                    <p class="text-center">No contacts found for this customer.</p>
                    <div class="text-center">
                        <a href="{{ route('customers.contacts.create', $customer->id) }}" class="btn btn-primary">Add Contact</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
