<?php

namespace App\Livewire\User;

use App\Models\Service as ServiceModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
class Service extends Component
{
    public function render()
    {
        $services = ServiceModel::latest()->get();
        
        $itemList = [];
        $position = 1;
        foreach ($services as $service) {
            if (!empty($service->slug)) {
                $itemList[] = [
                    "@type" => "ListItem",
                    "position" => $position++,
                    "url" => url("/services/{$service->slug}")
                ];
            }
        }
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "ItemList",
            "itemListElement" => $itemList
        ];
        
        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.service', compact('services'))->layoutData([
            'title' => 'All Home Services & Repairs in Purnea - JustRepair',
            'description' => 'Explore our wide range of professional home repair and maintenance services available in Purnea. Book AC repair, plumbing, and electricians today.',
            'keywords' => 'services purnea, repair list purnea, technician categories, home maintenance purnea',
            'schema' => $schemaScript
        ]);
    }
}
