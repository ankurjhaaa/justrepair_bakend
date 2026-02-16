<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'favicon',
        'contact_email',
        'contact_phone',
        'whatsapp_number',
        'support_email',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'country',
        'postal_code',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'business_hours',
        'maintenance_mode',
        'registration_enabled',
        'currency',
        'currency_symbol',
        'footer_about',
        'copyright_text'
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'registration_enabled' => 'boolean',
    ];
}
