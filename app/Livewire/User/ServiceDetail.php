<?php

namespace App\Livewire\User;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.user')]
class ServiceDetail extends Component
{
    public $service;

    public function mount($slug)
    {
        $this->service = Service::where('slug', strtolower($slug))->first();
        if (!$this->service) {
            abort(404);
        }
    }

    public function render()
    {
        $serviceName = $this->service->name;
        $appName = \App\Models\Setting::first()->site_name ?? 'JustRepair';

        // Purnea SEO Focus
        $title = "Best {$serviceName} in Purnea | Top Rated Technicians | {$appName}";
        $description = "Looking for professional {$serviceName} in Purnea? Book verified and expert technicians at your doorstep with {$appName}. Serving Line Bazar, Bhatta Bazar & more.";
        $keywords = strtolower("{$serviceName} purnea, best {$serviceName} in purnea, purnea {$serviceName} technicians, {$serviceName} near me purnea");
        
        // JSON-LD Schema
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "Service",
                    "name" => "{$serviceName} in Purnea",
                    "provider" => [
                        "@type" => "LocalBusiness",
                        "name" => $appName,
                        "address" => [
                            "@type" => "PostalAddress",
                            "addressLocality" => "Purnea",
                            "addressRegion" => "Bihar",
                            "addressCountry" => "IN"
                        ]
                    ],
                    "areaServed" => [
                        "@type" => "City",
                        "name" => "Purnea"
                    ],
                    "description" => $description,
                    "url" => url()->current(),
                    "offers" => [
                        "@type" => "Offer",
                        "priceCurrency" => "INR",
                        "price" => "99.00",
                        "availability" => "https://schema.org/InStock"
                    ]
                ],
                [
                    "@type" => "BreadcrumbList",
                    "itemListElement" => [
                        [
                            "@type" => "ListItem",
                            "position" => 1,
                            "name" => "Home",
                            "item" => url('/')
                        ],
                        [
                            "@type" => "ListItem",
                            "position" => 2,
                            "name" => "Services",
                            "item" => route('service')
                        ],
                        [
                            "@type" => "ListItem",
                            "position" => 3,
                            "name" => $serviceName
                        ]
                    ]
                ],
                [
                    "@type" => "FAQPage",
                    "mainEntity" => [
                        [
                            "@type" => "Question",
                            "name" => "How soon can a technician reach my home in Purnea?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Depending on availability, our professionals can usually reach your location in Purnea within a few hours of booking."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Is there a warranty on the {$serviceName}?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Yes, we provide a service warranty. Any issues post-service are handled with priority."
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.service-detail')
            ->layoutData([
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'schema' => $schemaScript
            ]);
    }
}
