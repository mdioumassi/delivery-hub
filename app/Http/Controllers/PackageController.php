<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['service', 'client', 'tracking'])->paginate(10);
        //$packages = Package::paginate(10);
        
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:envoi routier,envoi maritime,envoi aérien',
            'weight' => 'required',
            'unit_price' => 'required|numeric',
            'status' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:users,id'
        ]);

        $package = Package::create($validated);

          // Créer le tracking initial
          $package->tracking()->create([
            'status' => 1, // Status initial
            'tracking_date' => now(),
            'notes' => 'Package créé'
        ]);


        return redirect()->route('packages.index')->with('success', 'Colis créé');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'type' => 'required|in:envoi routier,envoi maritime,envoi aérien',
            'weight' => 'required',
            'unit_price' => 'required|numeric',
            'status' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:users,id'
        ]);

        $package->update($validated);

          // Ajouter une entrée de tracking si le statut a changé
          if ($package->wasChanged('status')) {
            $package->tracking()->create([
                'status' => $validated['status'],
                'tracking_date' => now(),
                'notes' => 'Statut mis à jour'
            ]);
        }

        return redirect()->route('packages.index')->with('success', 'Colis mis à jour');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}