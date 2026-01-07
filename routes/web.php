<?php

use App\Http\Controllers\LoginController;
use App\Livewire\Admin\AdminDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth','role:admin'])->prefix('admin/')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboard::class)->name('dashboard');
});

Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('loginsubmit', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');