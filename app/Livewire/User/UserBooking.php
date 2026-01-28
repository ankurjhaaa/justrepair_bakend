<?php

namespace App\Livewire\User;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.user')]
class UserBooking extends Component
{
    public $services;

    /* -------- STEP -------- */
    public int $step = 1;

    /* -------- MULTI SERVICES -------- */
    public array $selectedServiceIds = [];                 // [1,2]
    public array $selectedServiceRequirements = [];        // modal list
    public array $selectedRequirements = [];               // temp (modal)
    public array $allRequirements = [];                    // service_id => []

    public $activeService = null;
    public bool $showServiceModal = false;

    /* -------- BOOKING DATA -------- */
    public $date, $time;
    #[Validate('required|min:3')]
    public string $name = '';

    #[Validate('required|digits:10')]
    public string $mobile = '';

    #[Validate('required|string')]
    public string $city = '';

    #[Validate('required|string|min:5')]
    public string $address = '';

    #[Validate('nullable|string|max:255')]
    public string $landmark = '';

    public function mount()
    {
        if (request()->has('service')) {
            $services = request()->input('service');

            $this->selectedServiceIds = is_array($services)
                ? array_map('strval', $services)
                : [(string) $services];

            $this->step = 2;
        }
        $this->services = Service::latest()->get();
    }

    /* ================= SERVICE TOGGLE ================= */

    public function toggleService($serviceId)
    {
        // if already selected → remove
        if (in_array($serviceId, $this->selectedServiceIds)) {
            $this->selectedServiceIds = array_values(
                array_diff($this->selectedServiceIds, [$serviceId])
            );

            unset($this->allRequirements[$serviceId]);

            if (count($this->selectedServiceIds) === 0) {
                $this->step = 1;
            }

            return;
        }

        // else open modal
        $this->activeService = Service::findOrFail($serviceId);
        $this->selectedServiceRequirements = $this->activeService->requirements ?? [];
        $this->selectedRequirements = $this->allRequirements[$serviceId] ?? [];
        $this->showServiceModal = true;
    }

    public function confirmService()
    {
        $id = (string) $this->activeService->id;

        if (!in_array($id, $this->selectedServiceIds)) {
            $this->selectedServiceIds[] = $id;
        }

        $this->allRequirements[$id] = $this->selectedRequirements;

        $this->showServiceModal = false;
        $this->step = 2;
    }


    public function cancelService()
    {
        $this->activeService = null;
        $this->selectedRequirements = [];
        $this->showServiceModal = false;
    }

    /* ================= DATE ================= */

    public function selectDate($date)
    {
        $this->date = $date;
        $this->step = 3;
    }

    /* ================= TIME ================= */

    public function selectTime($time)
    {
        $this->time = $time;
        $this->step = 4;
    }

    /* ================= BOOKING ================= */

    public function bookService()
    {
        $this->validate([
            'selectedServiceIds' => 'required|array|min:1',
            'name' => 'required|string|min:3',
            'mobile' => 'required|string|min:10',
            'city' => 'required|string',
            'address' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            if (auth()->check()) {
                $userId = auth()->user()->id;
            } else {
                $user = User::firstOrCreate(
                    ['phone' => $this->mobile],
                    [
                        'name' => $this->name,
                        'role' => 'user',
                        'password' => Hash::make('password'),
                    ]
                );
                Auth::login($user);
                $userId = $user->id;
            }

            do {
                $bookingId = 'JR-' . rand(1000, 9999);
            } while (Booking::where('booking_id', $bookingId)->exists());

            $bookingDetail = Booking::create([
                'user_id' => $userId,
                'booking_id' => $bookingId,
                'service_ids' => $this->selectedServiceIds,
                'date' => $this->date,
                'time' => $this->time,
                'otp' => rand(100000, 999999),
                'name' => $this->name,
                'mobile' => $this->mobile,
                'address' => $this->address,
                'city' => $this->city,
                'landmark' => $this->landmark,
                'requirements' => $this->allRequirements,
            ]);

            DB::commit();
            session()->flash('success', 'Booking successful');
            return redirect()->route('bookingsuccess', $bookingDetail->booking_id);


        } catch (\Throwable $e) {
            DB::rollBack();
            $this->addError('booking', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.user-booking');
    }
}
