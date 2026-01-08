<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRate extends Model
{
    protected $guarded = [];
    protected $casts = [
        'includes' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
