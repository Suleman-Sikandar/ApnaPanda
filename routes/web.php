<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'XSS')->group(function () {
    Route::get('/customer/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/customer.php';
require __DIR__.'/vendor.php';
require __DIR__.'/admin.php';