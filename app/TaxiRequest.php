<?php

namespace App;

use App\Traits\FilterByCompanyScope;
use App\Traits\ObservantTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TaxiRequest extends Model
{
    use ObservantTrait, FilterByCompanyScope;

    public const STATUSES = [
        0 => 'Pending',
        1 => 'Confirmed',
        2 => 'Assigned',
        3 => 'Cancelled',
        4 => 'On Location',
        5 => 'Pick Up',
        6 => 'Drop Off'
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
        'on_location_time',
        'pick_up_time',
        'drop_off_time',
        'driver_id',
        'vehicle_id',
        'vehicle_type',
        'comment',
        'ordered_by',
    ];

    protected $appends = ['remaining_time'];

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

    public function getRemainingTimeAttribute()
    {
        $minutes = Carbon::now()->diffInMinutes($this->start_date, false);

        if ($minutes <= 0) {
            return '00:00';
        }

        $hours = floor($minutes/60);
        $minutes = ($minutes%60);

        if ($hours < 10) {
            $hours = '0'.$hours;
        }

        if ($minutes < 10) {
            $minutes = '0'.$minutes;
        }

        return $hours.':'.$minutes;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        $this->save();
    }

    public function sms_text($text)
    {
        return (string)Str::of($text)->replace('[start_date]', $this->start_date)
            ->replace('[driver]', $this->driver ? $this->driver->name : '')
            ->replace('[vehicle]', $this->vehicle ? $this->vehicle->name : '')
            ->replace('[type]', $this->vehicle ? $this->vehicle->type : '');
    }
}
