<?php

namespace App\Http\Controllers;

use App\Driver;
use Gate;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::filterByCompany()->with('company')->get();

        return view('concept.driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concept.driver.create');
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
            'company_id' => 'nullable|exists:companies,id'
        ]);

        Driver::create($validatedData);

        return redirect()->route('drivers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('driver.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        Gate::authorize('access-model', $driver->company_id);
        
        return view('concept.driver.create', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        Gate::authorize('access-model', $driver->company_id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'company_id' => 'nullable|exists:companies,id'
        ]);

        $driver->update($validatedData);

        return redirect()->route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        Gate::authorize('access-model', $driver->company_id);
        
        $driver->delete();

        return redirect()->route('drivers.index');
    }
}
