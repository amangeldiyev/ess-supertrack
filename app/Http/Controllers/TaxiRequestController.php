<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxiRequestStore;
use App\TaxiRequest;

class TaxiRequestController extends Controller
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
        return view('request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxiRequestStore $request)
    {
        $validatedData = $request->validated();

        $taxiRequest = TaxiRequest::create($validatedData);

        return redirect()->route('taxi-requests.show', ['taxi_request' => $taxiRequest]);
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
        return view('request.create', compact('taxiRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function update(TaxiRequestStore $request, TaxiRequest $taxiRequest)
    {
        $validatedData = $request->validated();

        $taxiRequest->update(array_merge($validatedData, ['driver_in_time' => $validatedData['driver_in_time'] ?? 0]));

        return redirect()->route('taxi-requests.show', ['taxi_request' => $taxiRequest]);
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
