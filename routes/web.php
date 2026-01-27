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
use App\Livewire\User\AboutUs;
use App\Livewire\User\BookingSuccess;
use App\Livewire\User\Contact;
use App\Livewire\User\HelpCenter;
use App\Livewire\User\Home;
use App\Livewire\User\Login;
use App\Livewire\User\MobileProfile;
use App\Livewire\User\MyBooking;
use App\Livewire\User\MyBookingView;
use App\Livewire\User\PrivacyPolicy;
use App\Livewire\User\Profile;
use App\Livewire\User\ProfileMyBooking;
use App\Livewire\User\ProfileMyBookingView;
use App\Livewire\User\Service;
use App\Livewire\User\Signup;
use App\Livewire\User\TermsAndCondition;
use App\Livewire\User\UserBooking;
use Illuminate\Support\Facades\Route;
use App\Livewire\ApiExplorer;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', Home::class)->name('home');
Route::get('login', Login::class)->name('login');
Route::get('signup', Signup::class)->name('register');
Route::get('about-us', AboutUs::class)->name('aboutus');
Route::get('help-center', HelpCenter::class)->name('helpcenter');
Route::get('privacy-policy', PrivacyPolicy::class)->name('privacypolicy');
Route::get('service', Service::class)->name('service');
Route::get('terms-and-condition', TermsAndCondition::class)->name('termsandcondition');
Route::get('booking', UserBooking::class)->name('booking');
Route::get('my-bookings', ProfileMyBooking::class)->name('mybookings');
Route::get('my-bookings/{booking_id}', ProfileMyBookingView::class)->name('mybookingview');
Route::get('contact', Contact::class)->name('contact');
Route::get('profile', Profile::class)->name('profile');
Route::get('/booking-success/{booking_id}', BookingSuccess::class)->name('bookingsuccess');
Route::get('/mobile-profile', MobileProfile::class)->name('mobileprofile');

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
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Route::post('pdf/generate', [PdfController::class, 'generatePdf'])->name('pdf.generate');

Route::get('pdf/generate/{booking_id}', [PdfController::class, 'generatePdf'])->name('pdf.generate.livewire');
