<?php

namespace App;

use App\Traits\FilterByCompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use ObservantTrait, FilterByCompanyScope;

    protected $fillable = ['name', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
