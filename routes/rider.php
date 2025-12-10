<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rider\ProfileController;
use App\Http\Controllers\Rider\DashboardController;

Route::middleware(['auth', 'XSS'])->group(function () {
    // Step 1: Personal
    Route::get('rider/profile/{id}', [ProfileController::class, 'profile'])->name('rider.profile');
    Route::post('rider/profile/{id}', [ProfileController::class, 'storeProfile'])->name('rider.profile.store');

    // Step 2: Vehicle
    Route::get('rider/vehicle/{id}', [ProfileController::class, 'vehicle'])->name('rider.vehicle');
    Route::post('rider/vehicle/{id}', [ProfileController::class, 'storeVehicle'])->name('rider.vehicle.store');

    // Step 3: Documents
    Route::get('rider/documents/{id}', [ProfileController::class, 'documents'])->name('rider.documents');
    Route::post('rider/documents/{id}', [ProfileController::class, 'storeDocuments'])->name('rider.documents.store');

    // Step 4: Address
    Route::get('rider/address/{id}', [ProfileController::class, 'address'])->name('rider.address');
    Route::post('rider/address/{id}', [ProfileController::class, 'storeAddress'])->name('rider.address.store');

    // Step 5: Face Verification
    Route::get('rider/face-verification/{id}', [ProfileController::class, 'faceVerification'])->name('rider.face.verification');
    Route::post('rider/face-verification/{id}', [ProfileController::class, 'processFaceVerification']);

    // Security
    Route::get('rider/security/{id}', [ProfileController::class, 'security'])->name('rider.security');
    Route::put('rider/password/{id}', [ProfileController::class, 'updatePassword']);

    //Dashboard
    Route::get('rider/dashboard/{id}', [DashboardController::class, 'index'])->name('rider.home');
});
