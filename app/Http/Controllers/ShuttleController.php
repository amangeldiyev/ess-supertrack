<?php

namespace App\Http\Controllers;

use App\Shuttle;
use Illuminate\Http\Request;
use Storage;

class ShuttleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shuttles = Shuttle::all();

        return view('concept.shuttle.index', compact('shuttles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concept.shuttle.create');
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
            'route' => 'required|array',
            'map' => 'nullable|image',
        ]);

        if (isset($validatedData['map'])) {
            $validatedData['map'] = Storage::disk('public')->put('maps', $request->file('map'));
        }

        Shuttle::create($validatedData);

        return redirect()->route('shuttles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function show(Shuttle $shuttle)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function edit(Shuttle $shuttle)
    {
        return view('concept.shuttle.create', compact('shuttle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shuttle $shuttle)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'route' => 'required|array',
            'map' => 'nullable|image',
        ]);

        if (isset($validatedData['map'])) {
            Storage::disk('public')->delete($shuttle->map);
            $validatedData['map'] = Storage::disk('public')->put('maps', $request->file('map'));
        }

        $shuttle->update($validatedData);

        return redirect()->route('shuttles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Shuttle  $shuttle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shuttle $shuttle)
    {
        $shuttle->delete();

        return redirect()->route('shuttles.index');
    }
}
