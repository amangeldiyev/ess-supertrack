<?php

namespace App\Http\Controllers;

use App\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('passenger.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('passenger.create');
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
            
        ]);

        $passenger = Passenger::create($validatedData);

        return redirect()->route('passenger.show', compact('passenger'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        return view('passenger.show', compact('passenger'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        //
    }
}
