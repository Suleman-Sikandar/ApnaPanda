<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('customer.home');
Route::get('customer/product-listing', [DashboardController::class, 'listing'])->name('customer.listing');
Route::get('customer/cart', [DashboardController::class, 'cart']);
Route::get('customer/checkout',[DashboardController::class, 'checkout']);
Route::get('customer/tracking', [DashboardController::class, 'track']);
Route::get('customer/orders', [DashboardController::class, 'order']);
// Route::get('customer/profile', [DashboardController::class, 'profile']);