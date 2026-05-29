<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
class HelpCenter extends Component
{
    public function render()
    {
        return view('livewire.user.help-center')->layoutData([
            'description' => 'Get support and answers to your questions about bookings, payments, and our services.',
            'keywords' => 'help center, customer support, faq, contact support, justrepair help'
        ]);
    }
}
