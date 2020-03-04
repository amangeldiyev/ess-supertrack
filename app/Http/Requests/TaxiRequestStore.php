<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxiRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'number' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'start_date' => 'required|date_format:d/m/Y H:i',
            'end_date' => 'required|date_format:d/m/Y H:i',
            'status' => 'required|numeric|between:0,5',
            'type' => 'required|numeric|between:0,1',
            'passenger_type' => 'required|numeric|between:0,1',
            'qty' => 'required|numeric|between:1,50',
            'driver_in_time' => 'boolean|nullable',
            'company_id' => 'required|exists:companies,id',
            'passenger' => 'required|string|max:255',
            'phone' => 'string|nullable|max:255',
            'pick_up_location' => 'required|string',
            'drop_off_location' => 'required|string',
            'on_location_time' => 'nullable|date_format:d/m/Y H:i',
            'pick_up_time' => 'nullable|date_format:d/m/Y H:i',
            'drop_off_time' => 'nullable|date_format:d/m/Y H:i',
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_type' => 'string|nullable',
            'comment' => 'string|nullable',
            'ordered_by' => 'required|exists:passengers,id',
        ];
    }
}
