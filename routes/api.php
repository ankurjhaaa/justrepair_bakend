<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
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
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/my-booked-services', 'myBookedServices')->name('myBookedServices');

    });
});
Route::controller(AuthController::class)->name('api.')->group(function () {
    Route::post('signup', 'signup')->name('signup');
    Route::post('login', 'login')->name('login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

    });
});
