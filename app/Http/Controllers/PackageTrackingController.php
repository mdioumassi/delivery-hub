<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageTracking;
use Illuminate\Http\Request;

class PackageTrackingController extends Controller
{
    public function index()
    {
        $trackings = PackageTracking::with(['package', 'container', 'destination'])
        ->latest('tracking_date')
        ->paginate(15);
        return view('trackings.index', compact('trackings'));
    }

    public function create()
    {
        return view('trackings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'container_id' => 'required|exists:containers,id',
            'destination_id' => 'required|exists:destinations,id',
            'status' => 'required|numeric',
            'notes' => 'nullable|string',
            'tracking_date' => 'required|date'
        ]);

        $tracking = PackageTracking::create($validated);

        // Mettre à jour le statut du package
        $package = Package::find($validated['package_id']);
        $package->update(['status' => $validated['status']]);

        return redirect()->route('trackings.index')->with('success', 'Suivi créé avec succès.');
    }

    public function edit(PackageTracking $packageTracking)
    {
        return view('trackings.edit', compact('packageTracking'));
    }

    public function update(Request $request, PackageTracking $packageTracking)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'container_id' => 'required|exists:containers,id',
            'destination_id' => 'required|exists:destinations,id',
            'tracking_date' => 'required|date',
            'status' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $packageTracking->update($validated);

        return redirect()->route('trackings.index')->with('success', 'Suivi mis à jour avec succès.');
    }

    public function destroy(PackageTracking $packageTracking)
    {
        $packageTracking->delete();
        return redirect()->route('trackings.index')->with('success', 'Suivi supprimé avec succès.');
    }
}