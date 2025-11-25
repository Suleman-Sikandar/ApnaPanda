<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ProfileController;

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