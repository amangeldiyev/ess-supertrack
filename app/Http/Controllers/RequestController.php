<?php

namespace App\Http\Controllers;

use App\Company;
use App\Driver;
use App\Passenger;
use App\TaxiRequest;
use App\Vehicle;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $passengers = Passenger::all();
        $drivers = Driver::all();
        $vehicles = Vehicle::all();

        return view('request.create', compact('companies', 'passengers', 'drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'date' => 'required|date_format:d/m/Y H:i',
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
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id|',
            'vehicle_type' => 'string|nullable',
            'comment' => 'string|nullable',
            'ordered_by' => 'required|exists:passengers,id',
        ]);

        $taxiRequest = TaxiRequest::create($validatedData);

        return redirect()->route('requests.show', ['request' => $taxiRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function show(TaxiRequest $taxiRequest)
    {
        return view('request.show', compact('taxiRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxiRequest $taxiRequest)
    {
        //
    }
}
