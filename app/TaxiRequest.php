<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxiRequest extends Model
{
    public const STATUSES = [
        0 => 'Pending',
        1 => 'Confirmed',
        2 => 'Assigned',
        3 => 'Pick Up',
        4 => 'Drop Off'
    ];

    public const TYPES = [
        0 => 'Business',
        1 => 'Other'
    ];

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

    public function client()
    {
        return $this->belongsTo(Passenger::class, 'ordered_by', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
