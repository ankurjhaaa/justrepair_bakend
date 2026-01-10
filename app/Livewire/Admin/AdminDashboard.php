<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Service;
use App\Models\Booking;
use App\Models\User;

#[Layout('layouts.admin')]
class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard', [
            'totalServices' => Service::count(),
            'totalBookings' => Booking::count(),
            'totalCustomers' => User::count(),
            'pendingBookings' => Booking::where('status', 'pending')->count(),

            'recentBookings' => Booking::latest()->take(5)->get(),

            'completedCount' => Booking::where('status', 'completed')->count(),
        ]);
    }
}
