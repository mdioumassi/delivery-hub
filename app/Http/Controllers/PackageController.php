<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $packages = Package::with(['service', 'sender', 'recipient','tracking'])->paginate(10);
        
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        $services = Service::all();
        $senders = User::where('type', 'Expéditeur')->get();
        $recipients = User::where('type', 'Récepteur')->get();
      
        return view('packages.create', compact('services', 'senders', 'recipients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'weight' => 'required',
            'unit_price' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'sender_id' => 'required|exists:users,id',
            'recipient_id' => 'required|exists:users,id'
        ]);
        $validated['status'] = 1; // Status initial

        $package = Package::create($validated);

          // Créer le tracking initial
          $package->tracking()->create([
            'package_id' => $package->id,
            'destination_id' => null,
            'status' => 1, // Status initial
            'tracking_date' => now(),
            'notes' => 'Package créé'
        ]);


        return redirect()->route('packages.index')->with('success', 'Colis créé');
    }

    public function show(Package $package)
    {
        dd($package);
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