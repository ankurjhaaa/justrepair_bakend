<?php

namespace App\Livewire\User;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.user')]
class Home extends Component
{
    public array $selectedServices = [];

    public function toggleService($id)
    {
        $id = (string) $id;

        if (in_array($id, $this->selectedServices)) {
            $this->selectedServices = array_values(
                array_diff($this->selectedServices, [$id])
            );
        } else {
            $this->selectedServices[] = $id;
        }
    }

    public function goToBooking()
    {
        if (count($this->selectedServices) === 0) {
            return;
        }

        return redirect()->route('booking', [
            'service' => $this->selectedServices
        ]);
    }

    public function render()
    {
        $appName = \App\Models\Setting::first()->site_name ?? 'JustRepair';
        
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "LocalBusiness",
                    "@id" => url('/') . "/#organization",
                    "name" => $appName,
                    "url" => url('/'),
                    "logo" => asset('logo.jpeg'),
                    "image" => asset('logo.jpeg'),
                    "description" => "JustRepair is the best home services and repair provider in Purnea. We offer expert technicians for AC repair, plumbing, electrical, and appliance repairs in Line Bazar, Bhatta Bazar, and all across Purnea.",
                    "telephone" => "+917280080080",
                    "priceRange" => "₹₹",
                    "address" => [
                        "@type" => "PostalAddress",
                        "streetAddress" => "Line Bazar",
                        "addressLocality" => "Purnea",
                        "addressRegion" => "Bihar",
                        "postalCode" => "854301",
                        "addressCountry" => "IN"
                    ],
                    "geo" => [
                        "@type" => "GeoCoordinates",
                        "latitude" => 25.7771,
                        "longitude" => 87.4753
                    ],
                    "areaServed" => [
                        [
                            "@type" => "City",
                            "name" => "Purnea"
                        ],
                        [
                            "@type" => "City",
                            "name" => "Katihar"
                        ],
                        [
                            "@type" => "City",
                            "name" => "Araria"
                        ]
                    ]
                ],
                [
                    "@type" => "WebSite",
                    "@id" => url('/') . "/#website",
                    "url" => url('/'),
                    "name" => $appName,
                    "publisher" => [
                        "@id" => url('/') . "/#organization"
                    ]
                ]
            ]
        ];

        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.home', [
            'services' => Service::latest()->get()
        ])->layoutData([
            'title' => 'JustRepair Purnea – #1 Home Repair & Technician Services',
            'description' => 'Book trusted technicians for AC repair, plumbing, electrical, and appliance services instantly in Purnea, Line Bazar, and Bhatta Bazar. Top rated home services.',
            'keywords' => 'ac repair purnea, best electrician purnea, plumbing purnea, washing machine repair purnea, home services purnea, justrepair purnea, technician near me purnea',
            'schema' => $schemaScript
        ]);
    }
}
