<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('orders.index');
});

Route::resource('customers', CustomerController::class);

Route::prefix('customers/{customer}')->group(function () {
    Route::post('phone_numbers', [CustomerController::class, 'storePhoneNumber'])->name('phone_numbers.store');
    Route::put('phone_numbers/{phone_number}', [CustomerController::class, 'updatePhoneNumber'])->name('phone_numbers.update');
    Route::delete('phone_numbers/{phone_number}', [CustomerController::class, 'destroyPhoneNumber'])->name('phone_numbers.destroy');

    Route::post('addresses', [CustomerController::class, 'storeAddress'])->name('addresses.store');
    Route::put('addresses/{address}', [CustomerController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('addresses/{address}', [CustomerController::class, 'destroyAddress'])->name('addresses.destroy');
});