<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Str;
use ImageKit\ImageKit;

#[Layout('layouts.admin')]
class AdminService extends Component
{
    use WithFileUploads;

    public $services = [];

    public $serviceId = null;
    public $name = '';
    public $image = null;
    public $existingImage = null; // imagekit fileId
    public $existingImageUrl = null;

    public $requirements = [];

    public $showModal = false;
    public $isEdit = false;

    protected function imageKit()
    {
        return new ImageKit(
            config('imagekit.public_key'),
            config('imagekit.private_key'),
            config('imagekit.url_endpoint')
        );
    }

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
        $this->existingImage = $service->image; // fileId
        $this->existingImageUrl = $service->image_url;
        $this->requirements = $service->requirements ?? [''];

        $this->image = null;
        $this->isEdit = true;
        $this->showModal = true;
        
    }

    /* ===============================
        SAVE / UPDATE (IMAGEKIT)
    ================================ */
    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'image' => $this->isEdit
                ? 'nullable|image|max:2048'
                : 'required|image|max:2048',
            'requirements' => 'array|min:1',
        ]);

        $fileId = $this->existingImage;
        $imageUrl = $this->existingImageUrl;

        if ($this->image) {

            // 🔥 delete old image from ImageKit (edit)
            if ($this->isEdit && $this->existingImage) {
                $this->imageKit()->deleteFile($this->existingImage);
            }

            // 🔥 upload to ImageKit
            $upload = $this->imageKit()->upload([
                'file' => base64_encode(file_get_contents($this->image->getRealPath())),
                'fileName' => time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension(),
                'folder' => '/services',
            ]);

            if (isset($upload->error)) {
                $this->addError('image', 'Image upload failed');
                return;
            }

            $fileId = $upload->result->fileId;
            $imageUrl = $upload->result->url;
        }

        Service::updateOrCreate(
            ['id' => $this->serviceId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'image' => $fileId,          // 🔑 ImageKit fileId
                'image_url' => $imageUrl,    // 🔗 ImageKit URL
                'requirements' => array_values(array_filter($this->requirements)),
            ]
        );

        $this->resetForm();
        $this->fetchServices();
    }

    /* ===============================
        DELETE SERVICE (IMAGEKIT)
    ================================ */
    public function delete($id)
    {
        $service = Service::findOrFail($id);

        // 🔥 delete image from ImageKit
        if ($service->image) {
            $this->imageKit()->deleteFile($service->image);
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
        $this->reset([
            'serviceId',
            'name',
            'image',
            'existingImage',
            'existingImageUrl',
            'requirements',
        ]);

        $this->showModal = false;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.admin.admin-service');
    }
}
