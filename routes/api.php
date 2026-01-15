<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TechnicianApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ApiController::class)->name('api.')->group(function () {
    Route::get('faq', 'faq')->name('faq');
    Route::get('services', 'service')->name('service');
    Route::get('service/{slug}', 'viewService')->name('viewService');
    Route::get('servicerates/{slug}', 'servicerates')->name('servicerates');
    Route::post('bookservice', 'bookservice')->name('bookservice');
    Route::get('userAddress/{id}', 'userAddress')->name('userAddress');
    Route::post('addUserAddress', 'addUserAddress')->name('addUserAddress');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my-booked-services', 'myBookedServices')->name('myBookedServices');
        Route::post('/cancel-booking', 'cancelBooking')->name('cancelBooking');
        Route::get('/view-service-booking/{booking_id}', 'viewServiceBooking')->name('viewServiceBooking');
        Route::post('re-shedule-booking', 'rescheduleBooking')->name('rescheduleBooking');

    });
});
Route::controller(TechnicianApiController::class)->prefix('technician')->name('api.technician')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/stats', 'stats')->name('stats');
        Route::get('/technician-bookings', 'technicianBookings')->name('technicianBookings');
        Route::get('/view-service-booking/{booking_id}', 'viewServiceBooking')->name('viewServiceBooking');
        Route::get('/assigned-service-count', 'assignedServiceCount')->name('assignedServiceCount');
        Route::get('/assigned-service-in-progress', 'assignedServiceInProgress')->name('assignedServiceInProgress');
        Route::get('/today-jobs', 'todayJobs')->name('todayjobs');
        Route::get('/today-schedule', 'todaySchedule')->name('todaySchedule');
        Route::get('/upcoming-schedule', 'upcomingSchedule')->name('upcomingSchedule');
        Route::get('/start-service/{booking_id}','startService')->name('startservice');
        Route::get('/mark-complete/{booking_id}','markComplete')->name('markComplete');
        Route::post('otp-verify','otpVerify')->name('otpVerify');
    });
});
Route::controller(AuthController::class)->name('api.')->group(function () {
    Route::post('signup', 'signup')->name('signup');
    Route::post('login', 'login')->name('login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/editprofile', 'editProfile')->name('editProfile');

    });
});
