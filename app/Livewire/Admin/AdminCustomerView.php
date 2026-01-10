<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminCustomerView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public User $customer;

    public function mount($id)
    {
        $this->customer = User::findOrFail($id);
    }

    public function render()
    {
        $bookings = Booking::where('user_id', $this->customer->id)
            ->latest()
            ->paginate(5);

        return view('livewire.admin.admin-customer-view', [
            'bookings' => $bookings,
        ]);
    }
}
