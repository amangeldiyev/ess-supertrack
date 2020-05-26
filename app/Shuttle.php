<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    protected $guarded = [];

    protected $casts = [
        'route' => 'json'
    ];
}
