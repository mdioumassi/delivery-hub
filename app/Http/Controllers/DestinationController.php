<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Destination;
use App\Models\Service;
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
    // public function index()
    // {
    //     $countries = CountryLoader::countries();
    //     $destinations = Destination::paginate(10);
    //     $companies = Company::all();


    //     return view('destinations.index', compact('destinations', 'companies', 'countries'));
    // }

    public function index(Request $request)
    {
        $query = Destination::query()->with('service');

        // Filtrage par pays
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Filtrage par entreprise
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        // Filtrage par date de départ
        if ($request->filled('departure_date')) {
            $query->where('departure_date', '>=', $request->departure_date);
        }

        // Récupérer les destinations paginées
        $destinations = $query->orderBy('departure_date', 'asc')->paginate(10);

        // Récupérer la liste des pays distincts pour le filtre
        $countriesOptions = Destination::distinct('country')->pluck('country')->toArray();

        // Récupérer toutes les entreprises pour le filtre
        $services = Service::all();

        return view('destinations.index', compact('destinations', 'countriesOptions', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = CountryLoader::countries();
        $companies = Company::with('services')->get();

        return view('destinations.create', compact('countries', 'companies'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinations' => 'required|array',
            'destinations.*.country' => 'required|string|max:100',
            'destinations.*.service_id' => 'required|exists:services,id',
            'destinations.*.departure_date' => 'nullable|date',
            'destinations.*.arrival_date' => 'nullable|date|after_or_equal:destinations.*.departure_date',
            'destinations.*.flight_name' => 'required|string|max:50',
        ]);

        foreach ($validated['destinations'] as $destinationData) {
            Destination::create($destinationData);
        }

        return redirect()->route('destinations.index')
            ->with('success', 'Les destinations ont été ajoutées avec succès');
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
        $validated = $request->validate([
            'country' => 'required|string|max:100',
            'service_id' => 'required|exists:services,id',
            'departure_date' => 'nullable|date',
            'arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'flight_name' => 'required|string|max:50',
        ]);

        $destination->update($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'La destination a été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'La destination a été supprimée avec succès');
    }
}
