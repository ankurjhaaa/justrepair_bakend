<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use Carbon\Carbon;

#[Layout('layouts.admin')]
class AdminBooking extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Filters
    public $search = '';
    public $status = '';
    public $date = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function resetFilters()
    {
        $this->search = '';
        $this->status = '';
        $this->date = '';
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bookings = Booking::query()->with('user', 'service')

            // 🔍 Search
            ->when($this->search, function ($q) {
                $q->where('booking_id', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('mobile', 'like', '%' . $this->search . '%');
            })

            // 📌 Status filter
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })

            // 📅 Date filter
            ->when($this->date, function ($q) {
                $q->whereDate('date', Carbon::parse($this->date));
            })

            ->latest()
            ->paginate(10);

        return view('livewire.admin.admin-booking', [
            'bookings' => $bookings,
        ]);
    }
}
