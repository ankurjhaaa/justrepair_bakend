<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.admin')]
class AdminBookingView extends Component
{
    public function render()
    {
        $service = Booking::where('id', 1)->first();
        return view('livewire.admin.admin-booking-view',compact('service'));
    }
}
