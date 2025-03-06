<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

// Customer grouping route
Route::get('customers/group', [CustomerController::class, 'group'])->name('customers.group');

// Customer routes
Route::resource('customers', CustomerController::class);

// Nested resource routes for contacts
Route::resource('customers.contacts', ContactController::class);

// Sales routes
Route::resource('sales', SaleController::class);
Route::get('sales-report', [SaleController::class, 'report'])->name('sales.report');
