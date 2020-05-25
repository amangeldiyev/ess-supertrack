<?php

namespace App\Http\Controllers;

use App\Imports\PassengersImport;
use App\Passenger;
use Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = strtolower(request('q'));

        $passengers = Passenger::filterByCompany()->when($q, function ($query, $q) {
            return $query->search($q);
        })->with('company')->paginate(10);

        return view('concept.passenger.index', compact('passengers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concept.passenger.create');
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
            'badge_number' => 'required|unique:passengers|numeric|max:99999999',
            'phone' => 'string|max:15|nullable',
            'email' => 'string|email|max:255|nullable',
            'lang' => 'required|integer|between:0,2',
            'sms_notification' => 'boolean|nullable',
            'email_notification' => 'boolean|nullable',
            'company_id' => 'nullable|exists:companies,id'
        ]);

        Passenger::create($validatedData);

        return redirect()->route('passengers.index');
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
        Gate::authorize('access-model', $passenger->company_id);
        
        return view('concept.passenger.create', compact('passenger'));
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
        Gate::authorize('access-model', $passenger->company_id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'badge_number' => 'required|unique:passengers,badge_number,'.$passenger->id.'|numeric|max:99999999',
            'phone' => 'string|max:15|nullable',
            'email' => 'string|email|max:255|nullable',
            'lang' => 'required|integer|between:0,2',
            'sms_notification' => 'boolean|nullable',
            'email_notification' => 'boolean|nullable',
            'company_id' => 'required|exists:companies,id'
        ]);

        $passenger->update(array_merge(
            $validatedData,
            ['sms_notification' => $validatedData['sms_notification'] ?? 0],
            ['email_notification' => $validatedData['email_notification'] ?? 0]
        ));

        return redirect()->route('passengers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        Gate::authorize('access-model', $passenger->company_id);

        $passenger->delete();

        return redirect()->route('passengers.index');
    }

    public function import(Request $request)
    {
        if ($request->isMethod('POST')) {
            $company_id = $request->company_id ?? auth()->user()->company_id;

            Gate::authorize('access-model', $company_id);

            Excel::import(new PassengersImport($company_id), $request->file('import'));
        }

        return view('concept.passenger.import');
    }

    public function search(Request $request)
    {
        $passengers = Passenger::filterByCompany()
            ->search(strtolower($request->q))
            ->limit(10)
            ->get();

        return response()->json($passengers);
    }
}
