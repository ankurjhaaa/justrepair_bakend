<?php

namespace App\Livewire\User;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class MyBooking extends Component
{
    public $bookings = [];
    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->get();

    }
    public function render()
    {

        return view('livewire.user.my-booking');
    }
}
