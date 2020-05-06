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

    /**
     * Get the passenger's language preference.
     *
     * @param  string  $value
     * @return string
     */
    public function getLangAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'Kazakh';
                break;
            case 2:
                return 'Russian';
                break;
            default:
                return 'English';
                break;
        }
    }

    /**
     * Get the passenger's language preference.
     *
     * @param  string  $value
     * @return string
     */
    public function getNotificationMethodAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'SMS';
                break;
            default:
                return 'Email';
                break;
        }
    }
}
