<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
#[Title('About Us - JustRepair')]
class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.user.about-us')->layoutData([
            'description' => 'Learn about JustRepair, the leading platform for trusted local home services and repairs.',
            'keywords' => 'about justrepair, company profile, trusted technicians, our story'
        ]);
    }
}
