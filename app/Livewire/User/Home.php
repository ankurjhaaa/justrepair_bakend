<?php

namespace App\Livewire\User;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Home extends Component
{
    public function render()
    {
        $services = Service::latest()->get();

        return view('livewire.user.home', compact('services'));
    }
}
