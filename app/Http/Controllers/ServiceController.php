<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        // Récupérer les paramètres de filtrage
        $typeId = $request->input('type');
        $companyId = $request->input('name');
        $status = $request->input('status');
        
        // Requête de base avec relations préchargées
        $query = Service::query()
                        ->with('company');
        
        // Appliquer les filtres si présents
        if ($typeId) {
            $query->where('type', $typeId);
        }
        
        if ($companyId) {
            $query->where('name', $companyId);
        }
        
        if ($status !== null && $status !== '') {
            $query->where('is_active', $status);
        }
        
        // Récupérer les résultats paginés
        $services = $query->latest()->paginate(10)
                         ->appends($request->except('page'));
        
        // Récupérer les données pour les listes déroulantes de filtrage
        
        $companies = Company::orderBy('name')->get();
        
        return view('services.index', compact('services',  'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        $services = Service::all();
        return view('services.create', compact('companies', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'description' => 'nullable',
            'is_active' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service)
    {
        $companies = Company::all();
        $services = Service::all();
        return view('services.edit', compact('service', 'companies', 'services'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type' => 'required',
            'description' => 'nullable',
            'is_active' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }
}