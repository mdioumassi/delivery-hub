<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ContainerController extends Controller
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
        $containers = Container::with(['service', 'sender', 'recipient','tracking'])->paginate(10);
        return view('containers.index', compact('containers'));
    }

    public function create()
    {
        $services = Service::all();
        $senders = User::where('type', 'Expéditeur')->get();
        $recipients = User::where('type', 'Récepteur')->get();
      
        return view('containers.create', compact('services', 'senders', 'recipients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'unit_price' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'sender_id' => 'required|exists:users,id',
            'recipient_id' => 'required|exists:users,id'
        ]);
        $validated['status'] = 1; // Status initial

        $container = Container::create($validated);

            // Créer le tracking initial
            $container->tracking()->create([
                'container_id' => $container->id,
                'destination_id' => null,
                'status' => 1, // Status initial
                'tracking_date' => now(),
                'notes' => 'Container créé'
            ]);

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
