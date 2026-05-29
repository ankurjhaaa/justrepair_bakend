<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
class TermsAndCondition extends Component
{
    public function render()
    {
        return view('livewire.user.terms-and-condition')->layoutData([
            'description' => 'Review our terms and conditions for using the JustRepair platform and services.',
            'keywords' => 'terms of service, conditions, user agreement, legal'
        ]);
    }
}
