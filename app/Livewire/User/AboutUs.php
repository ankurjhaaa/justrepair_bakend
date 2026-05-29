<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
class AboutUs extends Component
{
    public function render()
    {
        $appName = \App\Models\Setting::first()->site_name ?? 'JustRepair';
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "AboutPage",
            "name" => "About {$appName}",
            "description" => "Learn about JustRepair, Purnea's most trusted platform for home repairs and technician services.",
            "url" => url()->current(),
            "mainEntity" => [
                "@type" => "Organization",
                "name" => $appName,
                "description" => "We are building Purnea's most reliable platform to connect people with skilled and verified home service professionals.",
                "areaServed" => [
                    "@type" => "City",
                    "name" => "Purnea"
                ]
            ]
        ];
        
        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.about-us')->layoutData([
            'title' => 'About JustRepair Purnea | Trusted Home Services',
            'description' => 'Learn about JustRepair, Purnea\'s leading platform for trusted local home services and verified repair technicians.',
            'keywords' => 'about justrepair, company profile, trusted technicians purnea, home services purnea',
            'schema' => $schemaScript
        ]);
    }
}
