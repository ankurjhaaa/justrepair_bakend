<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Signup extends Component
{
    public string $name = '';
    public string $mobile = '';
    public string $password = '';

    protected $rules = [
        'name'     => 'required|string|min:3|max:100',
        'mobile'   => 'required|digits:10|unique:users,phone',
        'password' => 'required|min:6',
    ];

    public function signup()
    {
        $this->validate();

        try {
            $user = User::create([
                'name'     => $this->name,
                'phone'    => $this->mobile,
                'password' => Hash::make($this->password),
            ]);

            // auto login after signup (app behaviour)
            Auth::login($user);

            return redirect()->intended('/');

        } catch (\Exception $e) {
            $this->addError('mobile', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.user.signup');
    }
}
