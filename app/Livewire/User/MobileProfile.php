<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class MobileProfile extends Component
{
    public function mount()
    {
        if (!Auth::check()) {
            redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.user.mobile-profile');
    }
}
