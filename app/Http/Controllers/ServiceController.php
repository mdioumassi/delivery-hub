<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:type1,type2,type3',
            'description' => 'required',
            'is_active' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type' => 'required|in:type1,type2,type3',
            'description' => 'required',
            'is_active' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }
}