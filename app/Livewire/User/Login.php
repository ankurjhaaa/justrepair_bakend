<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Login extends Component
{
    public string $mobile = '';
    public string $password = '';
    public bool $remember = false;

    // OTP (secondary)
    public bool $otpMode = false;
    public string $otp = '';

    protected function rules()
    {
        if ($this->otpMode) {
            return [
                'mobile' => 'required|digits:10',
                'otp'    => 'required|min:4',
            ];
        }

        return [
            'mobile'   => 'required|digits:10',
            'password' => 'required|min:6',
        ];
    }

    public function login()
    {
        $this->validate();

        // 🔐 NORMAL LOGIN (API MATCH)
        if (!$this->otpMode) {
            $user = User::where('phone', $this->mobile)->first();

            if (!$user || !Hash::check($this->password, $user->password)) {
                $this->addError('mobile', 'Invalid mobile or password');
                return;
            }

            Auth::login($user, $this->remember);
            session()->regenerate();

            return redirect()->intended('/');
        }

        // 🔑 OTP LOGIN (TEMP PLACEHOLDER)
        if ($this->otp === '1234') {
            $user = User::where('phone', $this->mobile)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/');
            }

            $this->addError('mobile', 'User not found');
        } else {
            $this->addError('otp', 'Invalid OTP');
        }
    }

    public function toggleOtp()
    {
        $this->resetErrorBag();
        $this->otpMode = !$this->otpMode;
    }

    public function render()
    {
        return view('livewire.user.login');
    }
}
