<?php

namespace App;

use App\Traits\FilterByCompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use ObservantTrait, FilterByCompanyScope;
    
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
