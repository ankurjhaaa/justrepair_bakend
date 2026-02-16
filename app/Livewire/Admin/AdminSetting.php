<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.admin')]
class AdminSetting extends Component
{
    public $site_name, $site_tagline, $site_logo, $favicon;
    public $contact_email, $contact_phone, $whatsapp_number, $support_email;
    public $address_line_1, $address_line_2, $city, $state, $country, $postal_code;
    public $facebook_url, $instagram_url, $twitter_url, $linkedin_url, $youtube_url;
    public $meta_title, $meta_description, $meta_keywords;
    public $business_hours, $currency = 'INR', $currency_symbol = '₹', $footer_about, $copyright_text;
    public $maintenance_mode = false;
    public $registration_enabled = true;
    public $settingId;

    protected $rules = [
        'site_name' => 'nullable|string',
        'site_tagline' => 'nullable|string',
        'contact_email' => 'nullable|email',
        'contact_phone' => 'nullable|string',
        'whatsapp_number' => 'nullable|string',
        'support_email' => 'nullable|email',
        'address_line_1' => 'nullable|string',
        'address_line_2' => 'nullable|string',
        'city' => 'nullable|string',
        'state' => 'nullable|string',
        'country' => 'nullable|string',
        'postal_code' => 'nullable|string',
        'facebook_url' => 'nullable|url',
        'instagram_url' => 'nullable|url',
        'twitter_url' => 'nullable|url',
        'linkedin_url' => 'nullable|url',
        'youtube_url' => 'nullable|url',
        'meta_title' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
        'business_hours' => 'nullable|string',
        'maintenance_mode' => 'boolean',
        'registration_enabled' => 'boolean',
        'currency' => 'required|string',
        'currency_symbol' => 'required|string',
        'footer_about' => 'nullable|string',
        'copyright_text' => 'nullable|string',
    ];

    public function mount()
    {
        $setting = \App\Models\Setting::first();

        if (!$setting) {
            $setting = \App\Models\Setting::create([
                'site_name' => 'JustRepair',
                'currency' => 'INR',
                'currency_symbol' => '₹',
                'maintenance_mode' => false,
                'registration_enabled' => true,
            ]);
        }

        $this->settingId = $setting->id;
        $this->site_name = $setting->site_name;
        $this->site_tagline = $setting->site_tagline;
        $this->contact_email = $setting->contact_email;
        $this->contact_phone = $setting->contact_phone;
        $this->whatsapp_number = $setting->whatsapp_number;
        $this->support_email = $setting->support_email;
        $this->address_line_1 = $setting->address_line_1;
        $this->address_line_2 = $setting->address_line_2;
        $this->city = $setting->city;
        $this->state = $setting->state;
        $this->country = $setting->country;
        $this->postal_code = $setting->postal_code;
        $this->facebook_url = $setting->facebook_url;
        $this->instagram_url = $setting->instagram_url;
        $this->twitter_url = $setting->twitter_url;
        $this->linkedin_url = $setting->linkedin_url;
        $this->youtube_url = $setting->youtube_url;
        $this->meta_title = $setting->meta_title;
        $this->meta_description = $setting->meta_description;
        $this->meta_keywords = $setting->meta_keywords;
        $this->business_hours = $setting->business_hours;
        $this->maintenance_mode = (bool) $setting->maintenance_mode;
        $this->registration_enabled = (bool) $setting->registration_enabled;
        $this->currency = $setting->currency;
        $this->currency_symbol = $setting->currency_symbol;
        $this->footer_about = $setting->footer_about;
        $this->copyright_text = $setting->copyright_text;
    }

    public function render()
    {
        return view('livewire.admin.admin-setting');
    }

    public function save()
    {
        $this->validate();

        $setting = \App\Models\Setting::find($this->settingId);

        if ($setting) {
            $setting->update([
                'site_name' => $this->site_name,
                'site_tagline' => $this->site_tagline,
                'contact_email' => $this->contact_email,
                'contact_phone' => $this->contact_phone,
                'whatsapp_number' => $this->whatsapp_number,
                'support_email' => $this->support_email,
                'address_line_1' => $this->address_line_1,
                'address_line_2' => $this->address_line_2,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'postal_code' => $this->postal_code,
                'facebook_url' => $this->facebook_url,
                'instagram_url' => $this->instagram_url,
                'twitter_url' => $this->twitter_url,
                'linkedin_url' => $this->linkedin_url,
                'youtube_url' => $this->youtube_url,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
                'meta_keywords' => $this->meta_keywords,
                'business_hours' => $this->business_hours,
                'maintenance_mode' => $this->maintenance_mode,
                'registration_enabled' => $this->registration_enabled,
                'currency' => $this->currency,
                'currency_symbol' => $this->currency_symbol,
                'footer_about' => $this->footer_about,
                'copyright_text' => $this->copyright_text,
            ]);

            session()->flash('success', 'Settings updated successfully.');
        } else {
            // Redundant fallback if somehow deleted between mount and save
            \App\Models\Setting::create([
                // ... fields ...
            ]);
        }
    }
}
