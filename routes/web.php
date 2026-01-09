<?php

use App\Http\Controllers\LoginController;
use App\Livewire\Admin\AdminBooking;
use App\Livewire\Admin\AdminBookingView;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminService;
use App\Livewire\Admin\AdminServiceRate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin/')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('service', AdminService::class)->name('service');
    Route::get('service-rate', AdminServiceRate::class)->name('servicerate');
    Route::get('bookings', AdminBooking::class)->name('bookings');
    Route::get('booking-view', AdminBookingView::class)->name('bookingview');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('loginsubmit', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');