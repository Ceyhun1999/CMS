<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $casts = [
        'website_offline' => 'boolean',
    ];

    protected $fillable = [
        'website_name',
        'website_shortname',
        'website_url',
        'meta_description',
        'meta_keywords',
        'website_offline',
    ];
}
