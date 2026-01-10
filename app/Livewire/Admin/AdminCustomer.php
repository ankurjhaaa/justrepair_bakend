<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminCustomer extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Filters
    public $search = '';
    public $date = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->date = '';
        $this->resetPage();
    }

    public function render()
    {
        $customers = User::query()

            // 🔍 Search (name / phone)
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%');
            })

            // 📅 Date filter
            ->when($this->date, function ($q) {
                $q->whereDate('created_at', $this->date);
            })

            ->latest()
            ->paginate(10);

        return view('livewire.admin.admin-customer', [
            'customers' => $customers,
        ]);
    }
}
