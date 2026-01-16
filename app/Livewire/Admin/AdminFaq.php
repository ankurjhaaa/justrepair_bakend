<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Faq;
use App\Models\Service;

#[Layout('layouts.admin')]
class AdminFaq extends Component
{
    public $faqs;
    public $services;

    // Form fields
    public $faqId = null;
    public $service_id = '';
    public $title = '';
    public $description = '';

    // UI
    public $showModal = false;
    public $isEdit = false;

    // Filters
    public $filterService = '';
    public $search = '';

    public function mount()
    {
        $this->services = Service::select('id', 'name')->get();
        $this->fetchFaqs();
    }

    public function fetchFaqs()
    {
        $this->faqs = Faq::query()
            ->when($this->filterService !== '', function ($q) {
                if ($this->filterService === 'global') {
                    $q->whereNull('service_id');
                } else {
                    $q->where('service_id', $this->filterService);
                }
            })
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();
    }

    public function updatedFilterService()
    {
        $this->fetchFaqs();
    }

    public function updatedSearch()
    {
        $this->fetchFaqs();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        $this->faqId = $faq->id;
        $this->service_id = $faq->service_id ?? '';
        $this->title = $faq->title;
        $this->description = $faq->description;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:5',
            'service_id' => 'nullable|exists:services,id',
        ]);

        Faq::updateOrCreate(
            ['id' => $this->faqId],
            [
                'service_id' => $this->service_id ?: null,
                'title' => $this->title,
                'description' => $this->description,
            ]
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->isEdit ? 'FAQ updated successfully' : 'FAQ added successfully'
        );

        $this->resetForm();
        $this->fetchFaqs();
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'faq updated successfully'
        );
    }

    public function delete($id)
    {
        Faq::findOrFail($id)->delete();

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'FAQ deleted'
        );

        $this->fetchFaqs();
        $this->dispatch(
            'toast',
            type: 'error',
            message: 'FAQ deleted'
        );
    }

    private function resetForm()
    {
        $this->reset(['faqId', 'service_id', 'title', 'description']);
        $this->showModal = false;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.admin-faq');
    }
}
