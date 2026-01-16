<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    protected $casts = [
        'service_ids' => 'array',
        'requirements' => 'array',
        'additional_info' => 'array',
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function services()
    {
        return Service::whereIn('id', $this->service_ids ?? []);
    }
}
