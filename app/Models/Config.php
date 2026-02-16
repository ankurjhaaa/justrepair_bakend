<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'min_req_version',
        'current_version',
        'force_update',
        'update_url',
    ];

    protected $casts = [
        'force_update' => 'boolean',
    ];
}
