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

    public function index(Request $request)
    {
        // Démarrer la requête de base
        $query = Package::query()
            ->with(['sender', 'recipient']);

        // Recherche par texte (numéro de suivi, nom expéditeur, destinataire)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tracking_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('sender', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('recipient', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtre par date de début
        if ($request->filled('date_from')) {
            $query->whereDate('departure_date', '>=', $request->input('date_from'));
        }

        // Filtre par date de fin
        if ($request->filled('date_to')) {
            $query->whereDate('departure_date', '<=', $request->input('date_to'));
        }

        // Récupérer les résultats paginés
        $packages = $query->orderBy('created_at', 'desc')
            ->paginate(15);

        // Statistiques pour le tableau de bord
        $totalPackages = Package::count();
        $pendingPackages = Package::whereIn('status', ['created', 'processed'])->count();
        $inTransitPackages = Package::where('status', 'in_transit')->count();
        $deliveredThisMonth = Package::where('status', 'delivered')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();

        return view('packages.index', compact(
            'packages',
            'totalPackages',
            'pendingPackages',
            'inTransitPackages',
            'deliveredThisMonth'
        ));
    }

    // Méthode avancée pour l'exportation de données filtrées (optionnel)
    public function export(Request $request)
    {
        // Récupérer les mêmes filtres que la méthode index
        $query = Package::query()
            ->with(['sender', 'recipient']);

        // Appliquer les mêmes filtres que pour l'index
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tracking_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('sender', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('recipient', function ($q2) use ($search) {
                        $q2->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('departure_date', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('departure_date', '<=', $request->input('date_to'));
        }

        // Récupérer tous les résultats pour l'export
        $packages = $query->orderBy('created_at', 'desc')->get();

        // Logique d'exportation CSV/Excel...
        // Pour une implémentation complète, vous pourriez utiliser 
        // le package maatwebsite/excel

        // Code d'exemple pour un export CSV simple
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=colis-export.csv',
        ];

        $callback = function () use ($packages) {
            $file = fopen('php://output', 'w');
            // En-têtes CSV en français
            fputcsv($file, [
                'Numéro de suivi',
                'Type',
                'Poids',
                'Expéditeur',
                'Destinataire',
                'Date d\'envoi',
                'Statut',
                'Date de création'
            ]);

            foreach ($packages as $package) {
                fputcsv($file, [
                    $package->tracking_number,
                    $package->package_type,
                    $package->weight . ' kg',
                    $package->sender->name ?? 'N/A',
                    $package->recipient->name ?? 'N/A',
                    $package->departure_date ? date('d/m/Y', strtotime($package->departure_date)) : 'N/A',
                    $this->getStatusLabel($package->status),
                    date('d/m/Y H:i', strtotime($package->created_at))
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Helper pour obtenir le libellé du statut en français
    private function getStatusLabel($status)
    {
        switch ($status) {
            case 'created':
                return 'Créé';
            case 'processed':
                return 'Traité';
            case 'shipped':
                return 'Expédié';
            case 'in_transit':
                return 'En transit';
            case 'delivered':
                return 'Livré';
            default:
                return 'Inconnu';
        }
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
            'recipient_id' => 'required|exists:users,id',
            'status' => 'required'
        ]);


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
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $services = Service::all();
        $senders = User::where('type', 'Expéditeur')->get();
        $recipients = User::where('type', 'Récepteur')->get();
        return view('packages.edit', compact('package', 'services', 'senders', 'recipients'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'type' => 'required',
            'weight' => 'required',
            'unit_price' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
            'sender_id' => 'required|exists:users,id',
            'recipient_id' => 'required|exists:users,id',
            'status' => 'required'
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
