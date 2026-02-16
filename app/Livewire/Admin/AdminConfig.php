<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.admin')]
class AdminConfig extends Component
{
    public $min_req_version;
    public $current_version;
    public $force_update = false;
    public $update_url;
    public $configId;

    protected $rules = [
        'min_req_version' => 'required|string',
        'current_version' => 'required|string',
        'force_update' => 'boolean',
        'update_url' => 'required|url',
    ];

    public function mount()
    {
        $config = \App\Models\Config::first();

        if (!$config) {
            $config = \App\Models\Config::create([
                'min_req_version' => '1.0.0',
                'current_version' => '1.0.0',
                'force_update' => false,
                'update_url' => 'https://example.com',
            ]);
        }

        $this->configId = $config->id;
        $this->min_req_version = $config->min_req_version;
        $this->current_version = $config->current_version;
        $this->force_update = (bool) $config->force_update;
        $this->update_url = $config->update_url;
    }

    public function render()
    {
        return view('livewire.admin.admin-config');
    }

    public function save()
    {
        $this->validate();

        $config = \App\Models\Config::find($this->configId);

        if ($config) {
            $config->update([
                'min_req_version' => $this->min_req_version,
                'current_version' => $this->current_version,
                'force_update' => $this->force_update,
                'update_url' => $this->update_url,
            ]);
            session()->flash('success', 'Configuration updated successfully.');
        } else {
            // Fallback in case the record was deleted somehow
            \App\Models\Config::create([
                'min_req_version' => $this->min_req_version,
                'current_version' => $this->current_version,
                'force_update' => $this->force_update,
                'update_url' => $this->update_url,
            ]);
            session()->flash('success', 'Configuration created locally.');
        }
    }
}
