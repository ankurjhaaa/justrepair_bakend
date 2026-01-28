<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Profile extends Component
{
    public $name;
    public $mobile;
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        if (!Auth::check()) {
            redirect()->route('login');
        }
        $this->profile();
    }
    public function profile()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->mobile = $user->phone; // read-only

    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();

        $user->name = $this->name;

        // password sirf tab update hoga jab user bhare
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // clear password fields
        $this->password = '';
        $this->password_confirmation = '';

        session()->flash('success', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}
