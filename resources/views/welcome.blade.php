@extends('layouts.app')

@section('title', 'Welcome to Customer Management System')

@section('content')
<div class="text-center my-5">
    <h1 class="display-4 mb-4">Customer Management System</h1>
    <p class="lead">A comprehensive application to manage customers, contacts, and sales</p>
</div>

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Customers</h3>
                <p class="card-text">Manage your customers, view their details, and organize them by location or category.</p>
                <a href="{{ route('customers.index') }}" class="btn btn-primary">Manage Customers</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Contacts</h3>
                <p class="card-text">Maintain contact information for each customer in your database.</p>
                <a href="{{ route('customers.index') }}" class="btn btn-primary">View Customers</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">Sales</h3>
                <p class="card-text">Record sales transactions and generate detailed reports based on time periods and customers.</p>
                <a href="{{ route('sales.index') }}" class="btn btn-primary">Manage Sales</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Recent Sales</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('sales.index') }}" class="btn btn-outline-primary">View All Sales</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Sales Reports</h3>
            </div>
            <div class="card-body">
                <p>Generate detailed sales reports based on various criteria.</p>
                <a href="{{ route('sales.report') }}" class="btn btn-outline-primary">View Reports</a>
            </div>
        </div>
    </div>
</div>
@endsection
