<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
#[Title('Privacy Policy - JustRepair')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.user.privacy-policy')->layoutData([
            'description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
            'keywords' => 'privacy policy, data protection, security, terms, user data'
        ]);
    }
}
