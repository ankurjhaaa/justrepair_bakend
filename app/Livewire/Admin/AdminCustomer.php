<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.admin')]
class AdminCustomer extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    /* =======================
     |  FILTERS
     ======================= */
    public $search = '';
    public $date = '';
    public $role = '';

    /* =======================
     |  ADD USER MODAL
     ======================= */
    public $showModal = false;

    public $name;
    public $phone;
    public $email;
    public $password;
    public $newRole;

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
    public function updatingRole()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'date', 'role']);
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
            'newRole' => 'required|in:user,technician',
        ];
    }

    /* =======================
     |  ADD USER
     ======================= */
    public function addUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->newRole,
        ]);

        $this->reset([
            'name',
            'phone',
            'email',
            'password',
            'newRole',
            'showModal'
        ]);
    }

    /* =======================
     |  RENDER
     ======================= */
    public function render()
    {
        $customers = User::query()

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

            // 🎭 Role filter
            ->when($this->role, function ($q) {
                $q->where('role', $this->role);
            })

            ->latest()
            ->paginate(30);

        return view('livewire.admin.admin-customer', [
            'customers' => $customers,
        ]);
    }
}
