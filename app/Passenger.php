<?php

namespace App;

use App\Traits\FilterByCompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Passenger extends Model
{
    use ObservantTrait, FilterByCompanyScope, Notifiable;
    
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
