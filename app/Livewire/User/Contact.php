<?php

namespace App\Livewire\User;


use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Contact extends Component
{
    public function render()
    {
        $appName = \App\Models\Setting::first()->site_name ?? 'JustRepair';
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "ContactPage",
            "name" => "Contact {$appName} in Purnea",
            "description" => "Get in touch with JustRepair for any home service or repair inquiries in Purnea.",
            "url" => url()->current(),
            "mainEntity" => [
                "@type" => "Organization",
                "name" => $appName,
                "telephone" => "+917280080080",
                "email" => "support@justrepair.in",
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "Line Bazar",
                    "addressLocality" => "Purnea",
                    "addressRegion" => "Bihar",
                    "postalCode" => "854301",
                    "addressCountry" => "IN"
                ]
            ]
        ];
        
        $schemaScript = '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';

        return view('livewire.user.contact')->layoutData([
            'title' => 'Contact JustRepair Purnea | Best Home Services Support',
            'description' => 'Contact our JustRepair Purnea support team for bookings, inquiries, or feedback. We are available 24/7 for all your home repair needs.',
            'keywords' => 'contact justrepair, purnea customer care, justrepair helpline, support justrepair purnea',
            'schema' => $schemaScript
        ]);
    }
}
