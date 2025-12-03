<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModuleCategoryController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\RoleController;use Illuminate\Support\Facades\Route;

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
});
