<?php

namespace App\Livewire\User;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class MyBookingView extends Component
{
    public Booking $booking;
    public array $servicesMap = [];

    public function mount($booking_id)
    {
        if (!Auth::check()) {
            redirect()->route('login');
        }
        $this->booking = Booking::where('booking_id', $booking_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // service_id => name map
        $this->servicesMap = Service::pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.user.my-booking-view');
    }
}
