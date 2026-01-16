<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceRate;
#[Layout('layouts.admin')]

class AdminServiceRate extends Component
{
    public $rates;
    public $services;

    public $rateId;
    public $service_id;
    public $title;
    public $duration;
    public $price;
    public $discount_price;
    public $includes = [];

    public $showModal = false;
    public $isEdit = false;

    public function mount()
    {
        $this->services = Service::all();
        $this->fetchRates();
    }

    public function fetchRates()
    {
        $this->rates = ServiceRate::with('service')->latest()->get();
    }

    public function create()
    {
        $this->resetForm();
        $this->includes = [''];
        $this->showModal = true;
    }

    public function edit($id)
    {
        $rate = ServiceRate::findOrFail($id);

        $this->rateId = $rate->id;
        $this->service_id = $rate->service_id;
        $this->title = $rate->title;
        $this->duration = $rate->duration;
        $this->price = $rate->price;
        $this->discount_price = $rate->discount_price;
        $this->includes = $rate->includes ?? [''];

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|min:3',
            'duration' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'includes' => 'array|min:1',
        ]);

        ServiceRate::updateOrCreate(
            ['id' => $this->rateId],
            [
                'service_id' => $this->service_id,
                'title' => $this->title,
                'duration' => $this->duration,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
                'includes' => array_values(array_filter($this->includes)),
            ]
        );

        $this->resetForm();
        $this->fetchRates();
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Service rate updated successfully'
        );
    }

    public function delete($id)
    {
        ServiceRate::findOrFail($id)->delete();
        $this->fetchRates();
        $this->dispatch(
            'toast',
            type: 'error',
            message: 'Service rate Delete successfully'
        );
    }

    public function addInclude()
    {
        $this->includes[] = '';
    }

    public function removeInclude($index)
    {
        unset($this->includes[$index]);
        $this->includes = array_values($this->includes);
    }

    private function resetForm()
    {
        $this->reset([
            'rateId',
            'service_id',
            'title',
            'duration',
            'price',
            'discount_price',
            'includes',
        ]);

        $this->showModal = false;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.admin-service-rate');
    }
}
