<?php

namespace App\Http\Controllers;

use App\Passenger;
use Gate;
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
        $passengers = Passenger::filterByCompany()->with('company')->get();

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
            'phone' => 'string|max:15',
            'email' => 'string|email|max:255',
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
            'phone' => 'string|max:15',
            'email' => 'string|email|max:255',
            'company_id' => 'required|exists:companies,id'
        ]);

        $passenger->update($validatedData);

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

    public function search(Request $request)
    {
        $q = strtolower($request->search);
        
        $passengers = Passenger::filterByCompany()->whereRaw('LOWER(name) like ?', ["%{$q}%"])
            ->orWhereRaw('LOWER(phone) like ?', ["%$q%"])
            ->orWhereRaw('LOWER(email) like ?', ["%$q%"])
            ->orWhereRaw('LOWER(badge_number) like ?', ["%$q%"])
            ->get();

        if ($request->expectsJson()) {
            $data = '';

            foreach ($passengers as $passenger) {
                $data .= `<option value="$passenger->name">$passenger->badge_number - $passenger->phone - $passenger->email</option>`;
            }
            return response()->json([
                'passengers' => $data
            ]);
        }
    }
}
