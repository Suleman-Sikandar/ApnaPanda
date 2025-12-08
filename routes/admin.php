<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModuleCategoryController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\OrderLogController;
use App\Http\Controllers\Admin\BusinessController;
use Illuminate\Support\Facades\Route;

// ---------------------------
// Admin Authentication Routes
// ---------------------------
Route::prefix('control')->name('control.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('Authentication', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('Authentication', [AdminAuthController::class, 'login'])->name('submit');
    });
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth:admin');
});

// ---------------------------
// Admin Panel Routes
// ---------------------------
// Dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::prefix('admin')->middleware('ADMIN', 'XSS')->name('admin.')->group(function () {

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('role');
    Route::post('roles', [RoleController::class, 'store'])->name('role.store');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    // Admin Users
    Route::get('user', [AdminUserController::class, 'index'])->name('user');
    Route::post('user', [AdminUserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/profile/{id}', [AdminUserController::class, 'show'])->name('user.show');

    // Module Categories
    Route::get('module-categories', [ModuleCategoryController::class, 'index'])->name('module.categories');
    Route::post('module-categories/store', [ModuleCategoryController::class, 'store'])->name('module.categories.store');
    Route::get('module-categories/edit/{id}', [ModuleCategoryController::class, 'edit'])->name('module.categories.edit');
    Route::post('module-categories/update/{id}', [ModuleCategoryController::class, 'update']);
    Route::delete('module-categories/delete/{id}', [ModuleCategoryController::class, 'destroy']);

    // Modules
    Route::get('modules', [ModuleController::class, 'index'])->name('modules');
    Route::post('modules/store', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('modules/edit/{id}', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::post('modules/update/{id}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('modules/delete/{id}', [ModuleController::class, 'destroy'])->name('modules.delete');
    //Vendors
    Route::get('vendors', [VendorController::class, 'index'])->name('vendors');
    Route::get('vendors/profile/{id}', [VendorController::class, 'show'])->name('vendors.show');
    Route::get('vendors/approve/{id}', [VendorController::class, 'approve'])->name('vendors.approve');
    Route::Post('vendors/approve/{id}', [VendorController::class, 'approve'])->name('vendors.approve');
    Route::get('vendors/reject/{id}', [VendorController::class, 'reject'])->name('vendors.reject');
    Route::Post('vendors/reject/{id}', [VendorController::class, 'rejectUpdate'])->name('vendors.reject');
    Route::get('vendors/suspend/{id}', [VendorController::class, 'suspend'])->name('vendors.suspend');
    Route::Post('vendors/suspend/{id}', [VendorController::class, 'suspendUpdate'])->name('vendors.suspend');
    Route::get('vendors/pending-approval', [VendorController::class, 'pendingApproval'])->name('vendors.pending');
    //Product Categories
    Route::get('product-categories', [ProductCategoryController::class, 'index'])->name('product.categories');
    Route::post('product-categories/store', [ProductCategoryController::class, 'store'])->name('product.categories.store');
    Route::get('product-categories/edit/{id}', [ProductCategoryController::class, 'edit'])->name('product.categories.edit');
    Route::post('product-categories/update/{id}', [ProductCategoryController::class, 'update']);
    Route::delete('product-categories/delete/{id}', [ProductCategoryController::class, 'destroy']);
    //products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Product Status Actions
    Route::post('products/active/{id}', [ProductController::class, 'active'])->name('products.active');
    Route::post('products/out_of_stock/{id}', [ProductController::class, 'outOfStock'])->name('products.outOfStock');
    Route::post('products/pending/{id}', [ProductController::class, 'pending'])->name('products.pending');
    Route::get('products/ban/{id}', [ProductController::class, 'ban'])->name('products.ban');
    Route::post('products/ban/{id}', [ProductController::class, 'banUpdate'])->name('products.banUpdate');
    Route::get('products-detail/{id}', [ProductController::class, 'show'])->name('products.detail');
    Route::get('products/image/delete/{id}', [ProductController::class, 'deleteImage'])->name('products.image.delete');
    
    // Payment Methods
    Route::get('payment-methods', [PaymentMethodController::class, 'index'])->name('payment_method.index');
    Route::get('payment-methods/create', [PaymentMethodController::class, 'create'])->name('payment_method.create');
    Route::post('payment-methods/store', [PaymentMethodController::class, 'store'])->name('payment_method.store');
    Route::get('payment-methods/edit/{id}', [PaymentMethodController::class, 'edit'])->name('payment_method.edit');
    Route::put('payment-methods/update/{id}', [PaymentMethodController::class, 'update'])->name('payment_method.update');
    Route::delete('payment-methods/delete/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_method.destroy');

    // Orders
    Route::get('orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('orders/detail/{id}', [OrderController::class,'show'])->name('orders.show');
    Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/edit/{id}', [OrderController::class,'edit'])->name('orders.edit');
    Route::post('orders/update/{id}', [OrderController::class,'update'])->name('orders.update');
    Route::delete('orders/delete/{id}', [OrderController::class,'destroy'])->name('orders.destroy');

    // Order Items
    Route::get('order-items', [OrderItemController::class,'index'])->name('order-items.index');
    Route::post('order-items/store', [OrderItemController::class, 'store'])->name('order-items.store');
    Route::get('order-items/edit/{id}', [OrderItemController::class,'edit'])->name('order-items.edit');
    Route::post('order-items/update/{id}', [OrderItemController::class,'update'])->name('order-items.update');
    Route::delete('order-items/delete/{id}', [OrderItemController::class,'destroy'])->name('order-items.destroy');

    // Order Logs
    Route::get('order-logs', [OrderLogController::class,'index'])->name('order-logs.index');
    Route::delete('order-logs/delete/{id}', [OrderLogController::class,'destroy'])->name('order-logs.destroy');
    //Business
    //Business
    Route::get('business', [BusinessController::class, 'index'])->name('business.index');
    Route::post('business/store', [BusinessController::class, 'store'])->name('business.store');
    Route::get('business/edit/{id}', [BusinessController::class, 'edit'])->name('business.edit');
    Route::post('business/update/{id}', [BusinessController::class, 'update'])->name('business.update');
    Route::delete('business/delete/{id}', [BusinessController::class, 'destroy'])->name('business.destroy');
});
  