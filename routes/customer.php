<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\CartController;

Route::get('/', [DashboardController::class, 'index'])->name('customer.home');
Route::get('customer/product-listing', [DashboardController::class, 'listing'])->name('customer.listing');
Route::get('customer/tracking', [DashboardController::class, 'track']);
Route::get('customer/orders', [CartController::class, 'order'])->name('customer.orders');
Route::get('customer/product/{id}', [DashboardController::class, 'productDetail'])->name('customer.product.detail');

//Cart
Route::get('customer/cart', [CartController::class, 'index'])->name('customer.cart.detailt');
Route::post('customer/cart/store/{id}', [CartController::class, 'store']);
Route::get('customer/all-cart/{id}', [CartController::class, 'showCart'])->name('customer.listing');
Route::post('cart/update-qty', [CartController::class, 'updateQty'])->name('cart.updateQty');
Route::delete('cart/customer/delete/{id}', [CartController::class, 'destroy']);
Route::get('customer/checkout/{id}', [CartController::class, 'checkout']);
Route::post('customer/place-order', [CartController::class, 'placeOrder'])->name('customer.placeOrder');