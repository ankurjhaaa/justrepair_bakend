<?php

namespace App\Livewire\User;

use App\Models\Service as ServiceModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
#[Title('Our Services - JustRepair')]
class Service extends Component
{
    public function render()
    {
        $services = ServiceModel::latest()->get();

        return view('livewire.user.service', compact('services'))->layoutData([
            'description' => 'Explore our wide range of home repair and maintenance services available near you.',
            'keywords' => 'services, repair list, technician categories, home maintenance'
        ]);
    }
}
