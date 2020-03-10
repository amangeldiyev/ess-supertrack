<?php

namespace App;

use App\Traits\FilterByCompanyScope;
use App\Traits\ObservantTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxiRequest extends Model
{
    use ObservantTrait, FilterByCompanyScope;

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

    public static function boot()
    {
        parent::boot();

        self::created(function($model){

            if($model->status == 1) {
                // Notify passenger about request confirmation
            }

            if($model->status == 2) {
                // Notify passenger about vehicle and driver assignment for request
            }
        });

        self::updated(function($model){

            if($model->getOriginal('status') != 1 && $model->status == 1) {
                // Notify passenger about request confirmation
            }

            if($model->getOriginal('status') != 2 && $model->status == 2) {
                // Notify passenger about vehicle and driver assignment for request
            }
        });
    }

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

    public function getRemainingTimeAttribute() {
        $minutes = Carbon::now()->diffInMinutes($this->start_date, false);

        if($minutes <= 0) {
            return '00:00';
        }

        $hours = floor($minutes/60);
        $minutes = ($minutes%60);

        if($hours < 10) {
            $hours = '0'.$hours;
        }

        if($minutes < 10) {
            $minutes = '0'.$minutes;
        }

        return $hours.':'.$minutes;

    }
}
