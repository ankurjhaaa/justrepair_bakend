<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Livewire\Admin\AdminBooking;
use App\Livewire\Admin\AdminBookingView;
use App\Livewire\Admin\AdminCustomer;
use App\Livewire\Admin\AdminCustomerView;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminFaq;
use App\Livewire\Admin\AdminService;
use App\Livewire\Admin\AdminServiceRate;
use App\Livewire\User\Home;
use App\Livewire\User\Login;
use App\Livewire\User\Signup;
use Illuminate\Support\Facades\Route;
use App\Livewire\ApiExplorer;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',Home::class)->name('home');
Route::get('login',Login::class)->name('login');
Route::get('signup',Signup::class)->name('register');

Route::middleware(['auth', 'role:admin'])->prefix('admin/')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('service', AdminService::class)->name('service');
    Route::get('service-rate', AdminServiceRate::class)->name('servicerate');
    Route::get('bookings', AdminBooking::class)->name('bookings');
    Route::get('booking-view/{id}', AdminBookingView::class)->name('bookingview');
    Route::get('customers', AdminCustomer::class)->name('customer');
    Route::get('customers-view/{id}', AdminCustomerView::class)->name('customerview');
    Route::get('faqs', AdminFaq::class)->name('faqs');
    Route::get('/api-explorer', ApiExplorer::class)->name('apis');


});

// Route::get('admin/login', [LoginController::class, 'login'])->name('login');
Route::post('loginsubmit', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::post('pdf/generate', [PdfController::class, 'generatePdf'])->name('pdf.generate');


