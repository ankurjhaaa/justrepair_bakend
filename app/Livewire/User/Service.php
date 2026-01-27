<?php

namespace App\Livewire\User;

use App\Models\Service as ServiceModel;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Service extends Component
{
    public function render()
    {
        $services = ServiceModel::latest()->get();

        return view('livewire.user.service', compact('services'));
    }
}
