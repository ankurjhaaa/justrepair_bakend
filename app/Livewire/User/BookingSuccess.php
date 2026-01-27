<?php

namespace App\Livewire\User;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class BookingSuccess extends Component
{
    public Booking $booking;

    public function mount(string $booking_id)
    {
        $this->booking = Booking::where('booking_id', $booking_id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.booking-success');
    }
}
