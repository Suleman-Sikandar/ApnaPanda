<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ProfileController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\OrderItemController;

Route::middleware(['auth', 'XSS'])->group(function () {
    Route::get('vendor/home', [DashboardController::class, 'index'])->name('vendor.home');

    // Profile Routes
    Route::get('vendor/business-profile/{id}', [ProfileController::class, 'vendor_profile'])->name('vendor.profile');
    Route::post('vendor/business-profile-store/{id}', [ProfileController::class, 'storeVendorDetail']);

    // Business Info
    Route::get('vendor/business-profile/business-information/{id}', [ProfileController::class, 'businessinfor'])->name('vendor.business.info');
    Route::post('vendor/business-profile/business-information/{id}', [ProfileController::class, 'businessinfoStore']);

    // Documents
    Route::get('vendor/documents/{id}', [ProfileController::class, 'documents'])->name('vendor.documents');
    Route::post('vendor/documents/{id}', [ProfileController::class, 'storeDocuments']);

    // Bank Details
    Route::get('vendor/bank/{id}', [ProfileController::class, 'bank'])->name('vendor.bank');
    Route::post('vendor/bank/{id}', [ProfileController::class, 'storeBank']);

    // Address
    Route::get('vendor/address/{id}', [ProfileController::class, 'address'])->name('vendor.address');
    Route::put('vendor/address/{id}', [ProfileController::class, 'storeAddress'])->name('vendor.address');

    // Security
    Route::get('vendor/security/{id}', [ProfileController::class, 'security'])->name('vendor.security');
    Route::put('vendor/password/{id}', [ProfileController::class, 'updatePassword']);

    // Face Verification
    Route::get('vendor/face-verification/{id}', [ProfileController::class, 'faceVerification'])->name('vendor.face.verification');
    Route::post('vendor/face-verification/{id}', [ProfileController::class, 'processFaceVerification']);

    //Products
    Route::get('vendor/products', [ProductController::class, 'index'])->name('vendor.product');
    Route::post('vendor/products', [ProductController::class, 'store'])->name('vendor.product.store');
    Route::get('vendor/products/{id}/edit', [ProductController::class, 'edit'])->name('vendor.product.edit');
    Route::put('vendor/products/{id}', [ProductController::class, 'update'])->name('vendor.product.update');
    Route::delete('vendor/products/{id}', [ProductController::class, 'destroy'])->name('vendor.product.destroy');
    Route::delete('vendor/products/image/{id}', [ProductController::class, 'deleteImage'])->name('vendor.product.image.delete');
    
    //Orders
    Route::get('vendor/orders', [OrderController::class, 'index'])->name('vendor.orders');
    Route::post('vendor/orders', [OrderController::class, 'store'])->name('vendor.orders.store');
    Route::get('vendor/orders/{id}', [OrderController::class, 'show'])->name('vendor.orders.detail');
    Route::get('vendor/orders/{id}/edit', [OrderController::class, 'edit'])->name('vendor.orders.edit');
    Route::put('vendor/orders/{id}', [OrderController::class, 'update'])->name('vendor.orders.update');
    Route::delete('vendor/orders/{id}', [OrderController::class, 'destroy'])->name('vendor.orders.destroy');

    //Order Items
    Route::get('vendor/order-items', [OrderItemController::class, 'index'])->name('vendor.order-items');
    Route::post('vendor/order-items', [OrderItemController::class, 'store'])->name('vendor.order-items.store');
    Route::get('vendor/order-items/{id}/edit', [OrderItemController::class, 'edit'])->name('vendor.order-items.edit');
    Route::put('vendor/order-items/{id}', [OrderItemController::class, 'update'])->name('vendor.order-items.update');
    Route::delete('vendor/order-items/{id}', [OrderItemController::class, 'destroy'])->name('vendor.order-items.destroy');

});