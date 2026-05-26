<?php

namespace App\Livewire\User;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.user')]
class SeoServicePage extends Component
{
    public $city;
    public $cityKey;
    public $service;

    public function mount($city, $service)
    {
        $cities = config('seo_cities.cities');
        
        $this->cityKey = strtolower($city);
        
        // 1. Verify City
        if (!array_key_exists($this->cityKey, $cities)) {
            abort(404);
        }
        $this->city = $cities[$this->cityKey];

        // 2. Verify Service
        $this->service = Service::where('slug', strtolower($service))->first();
        if (!$this->service) {
            abort(404);
        }
    }

    public function render()
    {
        $serviceName = $this->service->name;
        $cityName = $this->city;
        $appName = \App\Models\Setting::first()->site_name ?? 'JustRepair';

        // SEO Meta
        $title = "Best {$serviceName} in {$cityName} | Top Rated Technicians | {$appName}";
        $description = "Looking for professional {$serviceName} in {$cityName}? Book verified and expert technicians at your doorstep with {$appName}. Affordable rates & fast service.";
        $keywords = strtolower("{$serviceName} {$cityName}, best {$serviceName} in {$cityName}, {$cityName} {$serviceName} technicians, {$serviceName} near me");
        
        // JSON-LD Schema
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Service",
            "name" => "{$serviceName} in {$cityName}",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => $appName,
                "address" => [
                    "@type" => "PostalAddress",
                    "addressLocality" => $cityName,
                    "addressRegion" => "Bihar",
                    "addressCountry" => "IN"
                ]
            ],
            "description" => $description,
            "url" => url()->current()
        ];
        
        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.seo-service-page')
            ->layoutData([
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'schema' => $schemaScript
            ]);
    }
}
