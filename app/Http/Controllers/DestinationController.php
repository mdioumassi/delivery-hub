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

    public function index(Request $request)
    {
        $query = Destination::query()
            ->join('services', 'destinations.service_id', '=', 'services.id')
            ->join('companies', 'services.company_id', '=', 'companies.id')
            ->select(
                'destinations.*',
                'services.type as service_type',
                'companies.name as company_name'
            );

        // Filtres
        if ($request->filled('pays')) {
            $query->where('destinations.country', $request->pays);
        }

        if ($request->filled('service')) {
            $query->where('services.id', $request->service);
        }

        if ($request->filled('date_depart')) {
            $query->whereDate('destinations.departure_date', '>=', $request->date_depart);
        }

        // Récupération des données pour les filtres
        $countries = Destination::distinct('country')->pluck('country');
        $services = Service::all();

        // Regrouper par type de service
        $destinations = $query->get()
            ->groupBy('service_type');

        return view('destinations.index', compact('destinations', 'countries', 'services'));
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

    // Méthodes supplémentaires dans DestinationController.php
    public function edit(Destination $destination)
    {
        $services = Service::all();
        $countries = Destination::select('country')->distinct()->get()->pluck('country');

        return view('destinations.edit', compact('destination', 'services', 'countries'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'country' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'departure_date' => 'required|date',
            'arrival_date' => 'nullable|date',
            'transport_means' => 'required|string',
        ]);

        $destination->update($validated);

        return redirect()->route('destinations.index')
            ->with('success', 'Destination mise à jour avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->back()->with('success', 'Destination supprimée avec succès');
    }
}
