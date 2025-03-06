<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect()->route('customers.index');
});

// Customer routes
Route::resource('customers', CustomerController::class);

// Nested resource routes for contacts
Route::resource('customers.contacts', ContactController::class);

