<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Events\TaxiRequestStatusChanged;
use App\Http\Requests\TaxiRequestStore;
use App\TaxiRequest;
use App\Vehicle;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaxiRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $from = request('from');
        $to = request('to');
        $filter = request('filter');

        $taxiRequests = TaxiRequest::filterByCompany()
            ->filter($filter)
            ->when($from, function ($query, $from) {
                return $query->where('start_date', '>', $from);
            })
            ->when($to, function ($query, $to) {
                return $query->where('start_date', '<', $to);
            })
            ->latest()
            ->with('company', 'driver', 'client', 'vehicle');
        
        if ($filter || $from) {
            $taxiRequests = $taxiRequests->get();
        } else {
            $taxiRequests = $taxiRequests->paginate(10);
        }

        return view('concept.taxi-request.index', compact('taxiRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->expectsJson()) {
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

        if ($request->expectsJson()) {
            return $this->renderTable();
        }

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
        Gate::authorize('access-model', $taxiRequest->company_id);

        if ($request->expectsJson()) {
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
        Gate::authorize('access-model', $taxiRequest->company_id);

        $validatedData = $request->validated();

        $taxiRequest->update(array_merge($validatedData, ['driver_in_time' => $validatedData['driver_in_time'] ?? 0]));

        if ($request->expectsJson()) {
            return $this->renderTable();
        }

        return redirect()->route('taxi-requests.index');
    }

    /**
     * Set status to taxi-request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function setStatus(Request $request, TaxiRequest $taxiRequest, $status)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        $taxiRequest->setStatus($status);

        return $this->renderTable();
    }

    /**
     * Confirm taxi-request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, TaxiRequest $taxiRequest)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        $client = $taxiRequest->client;

        $text = $taxiRequest->sms_text($taxiRequest->company->confirm_sms_template[$client->lang]);

        if ($request->isMethod('PUT')) {
            $validatedData = $request->validate([
                'sms_notification' => 'boolean|nullable',
                'email_notification' => 'boolean|nullable',
            ]);

            if (Arr::exists($validatedData, 'sms_notification') || Arr::exists($validatedData, 'email_notification')) {
                event(new TaxiRequestStatusChanged(
                    $taxiRequest,
                    $text,
                    Arr::exists($validatedData, 'sms_notification'),
                    Arr::exists($validatedData, 'email_notification')
                ));
            }

            $taxiRequest->setStatus(1);
            
            return $this->renderTable();
        }

        $route = route('taxi-requests.confirm', ['taxiRequest'=>$taxiRequest]);
            
        return view('concept.taxi-request._notify', compact('client', 'text', 'taxiRequest', 'route'))->render();
    }

    /**
     * Driver on location.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function onLocation(Request $request, TaxiRequest $taxiRequest)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        $client = $taxiRequest->client;

        $text = $taxiRequest->sms_text($taxiRequest->company->on_location_sms_template[$client->lang]);

        if ($request->isMethod('PUT')) {
            $validatedData = $request->validate([
                'sms_notification' => 'boolean|nullable',
                'email_notification' => 'boolean|nullable',
            ]);

            if (Arr::exists($validatedData, 'sms_notification') || Arr::exists($validatedData, 'email_notification')) {
                event(new TaxiRequestStatusChanged(
                    $taxiRequest,
                    $text,
                    Arr::exists($validatedData, 'sms_notification'),
                    Arr::exists($validatedData, 'email_notification')
                ));
            }

            $taxiRequest->update([
                'status' => 4,
                'on_location_time' => Carbon::now()
            ]);
            
            return $this->renderTable();
        }

        $route = route('taxi-requests.onLocation', ['taxiRequest'=>$taxiRequest]);

        return view('concept.taxi-request._notify', compact('client', 'text', 'taxiRequest', 'route'))->render();
    }

    /**
     * Set driver to taxi-request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function setDriver(Request $request, TaxiRequest $taxiRequest)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        if ($request->isMethod('PUT')) {
            $validatedData = $request->validate([
                'driver_id' => 'required|exists:drivers,id',
            ]);

            $taxiRequest->update($validatedData);
            
            return $this->renderTable();
        }

        $drivers = Driver::filterByCompany($taxiRequest->company_id)->get();
            
        return view('concept.taxi-request._drivers', compact('drivers', 'taxiRequest'))->render();
    }

    /**
     * Set vehicle to taxi-request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function setVehicle(Request $request, TaxiRequest $taxiRequest)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        if ($request->isMethod('PUT')) {
            $validatedData = $request->validate([
                'vehicle_id' => 'required|exists:vehicles,id',
            ]);

            $taxiRequest->update($validatedData);
            
            return $this->renderTable();
        }

        $vehicles = Vehicle::filterByCompany($taxiRequest->company_id)->get();
            
        return view('concept.taxi-request._vehicles', compact('vehicles', 'taxiRequest'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxiRequest $taxiRequest)
    {
        Gate::authorize('access-model', $taxiRequest->company_id);

        $taxiRequest->delete();

        return back();
    }

    /**
     * Notify system.
     *
     * @return \Illuminate\Http\Response
     */
    public function systemNotify()
    {
        return response()->json([
            'unassigned' => TaxiRequest::filterByCompany()->unassigned()->count() ?: '',
            'overdue' => TaxiRequest::filterByCompany()->overdue()->count() ?: ''
        ]);
    }

    private function renderTable()
    {
        $from = request('from');
        $to = request('to');
        $filter = request('filter');

        if (!$filter && $from) {
            return;
        }

        $taxiRequests = TaxiRequest::filterByCompany()
            ->filter($filter)
            ->when($from, function ($query, $from) {
                return $query->where('start_date', '>', $from);
            })
            ->when($to, function ($query, $to) {
                return $query->where('start_date', '<', $to);
            })
            ->latest()
            ->with('company', 'driver', 'client', 'vehicle')
            ->get();
 
        return view('concept.taxi-request._table', compact('taxiRequests'))->render();
    }
}
