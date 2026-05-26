<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Layout('layouts.admin')]
class AdminTechnicianView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public User $technician;

    public $name;
    public $email;
    public $phone;
    
    public $password;
    public $password_confirmation;

    public function mount($id)
    {
        $this->technician = User::where('role', 'technician')->findOrFail($id);
        
        $this->name = $this->technician->name;
        $this->email = $this->technician->email;
        $this->phone = $this->technician->phone;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone,' . $this->technician->id,
            'email' => 'nullable|email|unique:users,email,' . $this->technician->id,
        ]);

        $this->technician->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        $this->dispatch('toast', message: 'Profile updated successfully!', type: 'success');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $this->technician->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['password', 'password_confirmation']);
        
        $this->dispatch('toast', message: 'Password updated successfully!', type: 'success');
    }

    public function render()
    {
        $bookings = Booking::where('assigned_to', $this->technician->id)
            ->latest()
            ->paginate(5);

        return view('livewire.admin.admin-technician-view', [
            'bookings' => $bookings,
        ]);
    }
}
