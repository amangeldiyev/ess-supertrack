<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'confirm_sms_template' => 'array',
        'assign_sms_template' => 'array',
        'cancel_sms_template' => 'array',
        'on_location_sms_template' => 'array',
    ];
}
