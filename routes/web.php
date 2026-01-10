<?php

use App\Http\Controllers\LoginController;
use App\Livewire\Admin\AdminBooking;
use App\Livewire\Admin\AdminBookingView;
use App\Livewire\Admin\AdminCustomer;
use App\Livewire\Admin\AdminCustomerView;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminFaq;
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
    Route::get('booking-view/{id}', AdminBookingView::class)->name('bookingview');
    Route::get('customers', AdminCustomer::class)->name('customer');
    Route::get('customers-view/{id}', AdminCustomerView::class)->name('customerview');
    Route::get('faqs', AdminFaq::class)->name('faqs');

});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('loginsubmit', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');