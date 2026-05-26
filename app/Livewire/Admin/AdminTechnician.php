<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.admin')]
class AdminTechnician extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    /* =======================
     |  FILTERS
     ======================= */
    public $search = '';
    public $date = '';

    /* =======================
     |  ADD USER MODAL
     ======================= */
    public $showModal = false;

    public $name;
    public $phone;
    public $email;
    public $password;


    /* =======================
     |  LIVE RESET
     ======================= */
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingDate()
    {
        $this->resetPage();
    }
    // Removed role update

    public function resetFilters()
    {
        $this->reset(['search', 'date']);
        $this->resetPage();
    }

    /* =======================
     |  VALIDATION RULES
     ======================= */
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }

    /* =======================
     |  ADD USER
     ======================= */
    public function addTechnician()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'technician',
        ]);

        $this->reset([
            'name',
            'phone',
            'email',
            'password',
            'showModal'
        ]);
    }

    /* =======================
     |  RENDER
     ======================= */
    public function render()
    {
        $technicians = User::query()

            // 🔍 Search (name / phone)
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%");
                });
            })

            // 📅 Date filter
            ->when($this->date, function ($q) {
                $q->whereDate('created_at', $this->date);
            })
            
            ->where('role', 'technician') // Restrict to only technicians

            ->latest()
            ->paginate(30);

        return view('livewire.admin.admin-technician', [
            'technicians' => $technicians,
        ]);
    }
}
