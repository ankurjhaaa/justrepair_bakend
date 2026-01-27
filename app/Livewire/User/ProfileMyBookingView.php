<?php

namespace App\Livewire\User;


use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class ProfileMyBookingView extends Component
{
    public $bookingId = null;
    public function mount($booking_id)
    {
        if (!Auth::check()) {
            redirect()->route('login');
        }
        $this->bookingId = $booking_id;
    }
    public function render()
    {

        return view('livewire.user.profile-my-booking-view');
    }
}
