<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'address',
        'map_link',
        'phone_primary',
        'phone_secondary',
        'email_primary',
        'email_secondary',
        'work_hours',
        'social_links',
        'additional_info',
        'logo_path'
    ];

    protected $casts = [
        'social_links' => 'array'
    ];
}