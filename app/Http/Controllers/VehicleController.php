<?php

namespace App\Http\Controllers;

use App\Imports\VehiclesImport;
use App\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::filterByCompany()->with('company')->get();

        return view('concept.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concept.vehicle.create');
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
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'company_id' => 'nullable|exists:companies,id'
        ]);
    
        Vehicle::create($validatedData);

        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        Gate::authorize('access-model', $vehicle->company_id);
        
        return view('concept.vehicle.create', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        Gate::authorize('access-model', $vehicle->company_id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'company_id' => 'required|exists:companies,id'
        ]);
    
        $vehicle->update($validatedData);

        return redirect()->route('vehicles.index');
    }

    /**
     * Import vehicles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        if ($request->isMethod('POST')) {
            $company_id = $request->company_id ?? auth()->user()->company_id;

            Gate::authorize('access-model', $company_id);

            Excel::import(new VehiclesImport($company_id), $request->file('import'));
        }

        return view('concept.vehicle.import');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        Gate::authorize('access-model', $vehicle->company_id);

        $vehicle->delete();

        return redirect()->route('vehicles.index');
    }
}
