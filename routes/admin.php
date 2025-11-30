<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    AdminAuthController,
    RoleController,
    AdminUserController,
    ModuleCategoryController,
};
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication Routes (Guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Admin Logout Route (Authenticated only)
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth');

    // // Protected Admin Routes (Authenticated only)
    // Route::middleware('auth')->group(function () {
    //     // Dashboard
    //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
    //     // Add more admin routes here as needed
    // });
});


Route::prefix('admin')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //Route For Admin Roles
    Route::get('roles', [RoleController::class, 'index'])->name('admin.role');
    Route::post('roles', [RoleController::class, 'store'])->name('admin.role.store');
    Route::Delete('roles/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    //Admin User Routes
    Route::get('user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::post('user', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::post('user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('user/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('user/profile/{id}', [AdminUserController::class, 'show'])->name('admin.user.show');

    //Routes for Module Categories 
    Route::get('module-categories', [ModuleCategoryController::class, 'index'])->name('admin.module.categories');
    Route::post('module-categories/store', [ModuleCategoryController::class, 'store'])->name('admin.module.categories.store');
    Route::get('module-categories/edit/{id}', [ModuleCategoryController::class, 'edit'])->name('admin.module.categories.edit');
    Route::post('module-categories/update/{id}', [ModuleCategoryController::class, 'update']);
    Route::delete('module-categories/delete/{id}', [ModuleCategoryController::class, 'destroy']);
});