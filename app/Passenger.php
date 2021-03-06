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

    public function scopeSearch($query, $q)
    {
        $query->whereRaw('LOWER(name) like ?', ["%{$q}%"])
            ->orWhereRaw('LOWER(phone) like ?', ["%$q%"])
            ->orWhereRaw('LOWER(email) like ?', ["%$q%"])
            ->orWhereRaw('LOWER(badge_number) like ?', ["%$q%"]);
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
                return 'kz';
                break;
            case 2:
                return 'ru';
                break;
            default:
                return 'eng';
                break;
        }
    }
}
