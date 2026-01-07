<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Service;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class AdminService extends Component
{
    use WithFileUploads;

    public $services = [];

    public $serviceId = null;
    public $name = '';
    public $image = '';
    public $existingImage;

    public $requirements = [];

    public $showModal = false;
    public $isEdit = false;

    public function mount()
    {
        $this->fetchServices();
    }

    public function fetchServices()
    {
        $this->services = Service::latest()->get();
    }

    public function create()
    {
        $this->resetForm();
        $this->requirements = [''];
        $this->showModal = true;
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $this->serviceId = $service->id;
        $this->name = $service->name;
        $this->existingImage = $service->image; // 👈 old image
        $this->requirements = $service->requirements ?? [''];

        $this->image = null; // reset new image
        $this->isEdit = true;
        $this->showModal = true;
    }


    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'image' => $this->isEdit ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'requirements' => 'array|min:1',
        ]);

        $imagePath = $this->existingImage;

        if ($this->image) {
            $imagePath = $this->image->store('services', 'public');
        }
        $imageUrl = asset('storage/' . $imagePath);

        Service::updateOrCreate(
            ['id' => $this->serviceId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'image' => $imagePath,
                'image_url' => $imageUrl,
                'requirements' => array_values(array_filter($this->requirements)),
            ]
        );

        $this->resetForm();
        $this->fetchServices();
    }



    public function delete($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        $this->fetchServices();
    }

    public function addRequirement()
    {
        $this->requirements[] = '';
    }

    public function removeRequirement($index)
    {
        unset($this->requirements[$index]);
        $this->requirements = array_values($this->requirements);
    }
    private function resetForm()
    {
        $this->reset(['serviceId', 'name', 'image', 'existingImage', 'requirements']);
        $this->showModal = false;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.admin-service');
    }
}
