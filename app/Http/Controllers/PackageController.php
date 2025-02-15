<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['service', 'packageTracking', 'destination'])->paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'weight' => 'required|string',
            'unit_price' => 'required|numeric',
            'service_id' => 'required|exists:services,id'
        ]);

        $package = Package::create($validated);

        return redirect()->route('packages.show', $package)
            ->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'weight' => 'required|string',
            'unit_price' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $package->update($validated);

        return redirect()->route('packages.show', $package)
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}