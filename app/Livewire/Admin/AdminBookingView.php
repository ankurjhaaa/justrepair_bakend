<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminBookingView extends Component
{
    public Booking $booking;

    public $status;
    public $admin_note;
    public $assigned_to;
    public $total_amount;
    public $payment_method;
    public $is_paid = false;

    public function mount($id)
    {
        $this->booking = Booking::findOrFail($id);

        $this->status = $this->booking->status;
        $this->admin_note = $this->booking->admin_note;
        $this->assigned_to = $this->booking->assigned_to;
        $this->total_amount = $this->booking->total_amount;
        $this->payment_method = $this->booking->payment_method;
        $this->is_paid = $this->booking->is_paid;

    }

    public function updateAmount()
    {
        $this->booking->update([
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'is_paid' => $this->is_paid,
        ]);
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Payment details updated'
        );
    }

    public function updateStatus()
    {
        $this->booking->update([
            'status' => $this->status,
        ]);

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Status updated successfully'
        );

    }

    public function saveAdminNote()
    {
        $this->booking->update([
            'admin_note' => $this->admin_note,
        ]);
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Admin note saved successfully'
        );
       
    }

    public function assignTechnician()
    {
        $this->booking->update([
            'assigned_to' => $this->assigned_to,
            'assigned_at' => now(),
            'status' => 'assigned',
        ]);
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Technician assigned successfully'
        );
    }

    public function render()
    {
        return view('livewire.admin.admin-booking-view', [
            'servicesMap' => Service::pluck('name', 'id'),
            'technicians' => User::where('role', 'technician')->get(),
        ]);
    }
}
