<?php

namespace App\Http\Controllers;

use App\Models\PackageTracking;
use Illuminate\Http\Request;

class PackageTrackingController extends Controller
{
    public function index()
    {
        $trackings = PackageTracking::with(['package', 'container', 'destination'])->get();
        return view('package-trackings.index', compact('trackings'));
    }

    public function create()
    {
        return view('package-trackings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'container_id' => 'required|exists:containers,id',
            'destination_id' => 'required|exists:destinations,id',
            'tracking_date' => 'required|date',
            'status' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        PackageTracking::create($validated);

        return redirect()->route('package-trackings.index')->with('success', 'Suivi créé avec succès.');
    }

    public function edit(PackageTracking $packageTracking)
    {
        return view('package-trackings.edit', compact('packageTracking'));
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

        return redirect()->route('package-trackings.index')->with('success', 'Suivi mis à jour avec succès.');
    }

    public function destroy(PackageTracking $packageTracking)
    {
        $packageTracking->delete();
        return redirect()->route('package-trackings.index')->with('success', 'Suivi supprimé avec succès.');
    }
}