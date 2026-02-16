<?php

namespace App\Livewire\User;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
#[Title('Booking Successful - JustRepair')]
class BookingSuccess extends Component
{
    public Booking $booking;

    public function mount(string $booking_id)
    {
        $this->booking = Booking::where('booking_id', $booking_id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.booking-success')->layoutData([
            'description' => 'Your booking has been confirmed! View your booking details and track your technician.',
            'keywords' => 'booking success, order confirmed, service tracking'
        ]);
    }
}
