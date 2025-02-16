<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $containers = Container::with(['service', 'client', 'packageTrackings'])->paginate(10);
        return view('containers.index', compact('containers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:baril,valise,vehicule',
            'unit_price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:users,id'
        ]);

        Container::create($validated);
        return redirect()->route('containers.index')->with('success', 'Conteneur créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Container $container)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Container $container)
    {
        $validated = $request->validate([
            'type' => 'required|in:baril,valise,vehicule',
            'unit_price' => 'required|numeric',
            'description' => 'required',
            'status' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'client_id' => 'required|exists:users,id'
        ]);

        $container->update($validated);
        return redirect()->route('containers.index')->with('success', 'Conteneur mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Container $container)
    {
        //
    }
}
