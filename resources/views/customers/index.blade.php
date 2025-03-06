@extends('layouts.app')

@section('title', 'Customers List')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Customers</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('customers.group') }}" class="btn btn-info me-2">Group Customers</a>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <form action="{{ route('customers.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Search by name or email">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            @if(count($customers) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->location }}</td>
                                    <td>{{ $customer->category }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');" style="display: inline;">
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
                    {{ $customers->links() }}
                </div>
            @else
                <p class="text-center">No customers found.</p>
            @endif
        </div>
    </div>
@endsection
