<?php

namespace App\Livewire\User;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
#[Title('JustRepair – Home Services at Your Doorstep')]
class Home extends Component
{
    public array $selectedServices = [];

    public function toggleService($id)
    {
        $id = (string) $id;

        if (in_array($id, $this->selectedServices)) {
            $this->selectedServices = array_values(
                array_diff($this->selectedServices, [$id])
            );
        } else {
            $this->selectedServices[] = $id;
        }
    }

    public function goToBooking()
    {
        if (count($this->selectedServices) === 0) {
            return;
        }

        return redirect()->route('booking', [
            'service' => $this->selectedServices
        ]);
    }

    public function render()
    {
        return view('livewire.user.home', [
            'services' => Service::latest()->get()
        ])->layoutData([
                    'description' => 'Book trusted technicians for AC repair, plumbing, electrical, and appliance services instantly.',
                    'keywords' => 'ac repair, plumbing, electrician, appliance repair, home services, technician near me'
                ]);
    }
}
