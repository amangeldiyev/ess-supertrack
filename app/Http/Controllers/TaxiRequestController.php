<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxiRequestStore;
use App\TaxiRequest;
use Illuminate\Http\Request;

class TaxiRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxiRequests = TaxiRequest::latest()->with('company', 'driver', 'client', 'vehicle')->get();

        return view('concept.taxi-request.index', compact('taxiRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->expectsJson()) {
            return view('concept.taxi-request._form')->render();
        }

        return view('concept.taxi-request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaxiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxiRequestStore $request)
    {
        $validatedData = $request->validated();

        $taxiRequest = TaxiRequest::create($validatedData);

        return redirect()->route('taxi-requests.index', ['taxi_request' => $taxiRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function show(TaxiRequest $taxiRequest)
    {
        return view('concept.taxi-request.show', compact('taxiRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TaxiRequest $taxiRequest)
    {
        if($request->expectsJson()) {
            return view('concept.taxi-request._form', compact('taxiRequest'))->render();
        }

        return view('concept.taxi-request.create', compact('taxiRequest'));
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

        return redirect()->route('taxi-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxiRequest $taxiRequest)
    {
        $taxiRequest->delete();

        return redirect()->route('taxi-requests.index');
    }
}
