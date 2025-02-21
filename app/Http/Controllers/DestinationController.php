<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Destination;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;

class DestinationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::with(['company'])->paginate(10);

        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = CountryLoader::countries(); 
        $companies = Company::all();

        return view('destinations.create', compact('countries', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date',
            'company_id' => 'required|exists:companies,id',
            'package_id' => 'nullable|exists:packages,id',
            'container_id' => 'nullable|exists:containers,id'
        ]);

        Destination::create($validated);

        return redirect()->route('destinations.index')->with('success', 'Destination créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
