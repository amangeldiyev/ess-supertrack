<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxiRequest extends Model
{
    protected $fillable = [
        'number',
        'date',
        'start_date',
        'end_date',
        'status',
        'type',
        'passenger_type',
        'qty',
        'driver_in_time',
        'company_id',
        'passenger',
        'phone',
        'pick_up_location',
        'drop_off_location',
        'driver_id',
        'vehicle_id',
        'vehicle_type',
        'comment',
        'ordered_by',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function ordered_by()
    {
        return $this->belongsTo(Passenger::class, 'id', 'ordered_by');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
