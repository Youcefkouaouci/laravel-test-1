<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Route;


Route::get('/', [PropertyController::class, 'index'])->name('properties.index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/booking/{property}/create', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/dashboard', [BookingController::class, 'redirectBookings'])->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
