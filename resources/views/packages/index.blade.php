@extends('layouts.app')

@section('header')
Liste des colis
@endsection

@section('content')
<!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-end mb-4">
            <a href="{{ route('packages.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                Ajouter un colis
            </a>
        </div>
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type d'envoi
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Poids
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix unitaire
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Expéditeiur
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Récepteur
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Service
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($packages as $package)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->weight }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($package->unit_price, 2) }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $package->status === 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $package->status == 1 ? 'Actif' : 'En attente' }}
                        </span>
                    </td>
                    <td>{{ $package->sender->name }}</td>
                    <td>{{ $package->recipient->name }}</td>
                    <td>{{ $package->service->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('packages.show', $package) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            Voir
                        </a>
                        <a href="{{ route('packages.edit', $package) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                            Modifier
                        </a>
                        <form action="{{ route('packages.destroy', $package) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce colis ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $packages->links() }}
        </div>
    </div>
</div> -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Liste des colis</h2>
                    <a href="{{ route('packages.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
                        Nouveau colis
                    </a>
                </div>

                <!-- Filtres de recherche -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <form action="{{ route('packages.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Recherche</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Numéro, expéditeur..." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="created" {{ request('status') == 'created' ? 'selected' : '' }}>Créé</option>
                                <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Traité</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédié</option>
                                <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>En transit</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livré</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700">Date de début</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700">Date de fin</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="md:col-span-4 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition">
                                Filtrer
                            </button>
                            <a href="{{ route('packages.index') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Tableau des colis -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Numéro
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type de colis
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Poids
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Expéditeur
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Destinataire
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date d'envoi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($packages as $package)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $package->tracking_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @switch($package->type)
                                    @case('Valise')
                                    Valise
                                    @break
                                    @case('Medicament')
                                    Medicament
                                    @break
                                    @case('ALiment')
                                    ALiment
                                    @break
                                    @default
                                    {{ $package->type }}
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $package->weight }} kg
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $package->sender->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $package->recipient->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $package->departure_date ? date('d/m/Y', strtotime($package->departure_date)) : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($package->status ?? 'created')
                                    @case('created')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Créé
                                    </span>
                                    @break
                                    @case('processed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Traité
                                    </span>
                                    @break
                                    @case('shipped')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Expédié
                                    </span>
                                    @break
                                    @case('in_transit')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                        En transit
                                    </span>
                                    @break
                                    @case('delivered')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Livré
                                    </span>
                                    @break
                                    @default
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inconnu
                                    </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('packages.show', $package) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Voir
                                        </a>
                                        <a href="{{ route('packages.edit', $package) }}" class="text-blue-600 hover:text-blue-900">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('packages.destroy', $package->id) }}" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce colis?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Aucun colis trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $packages->withQueryString()->links() }}
                </div>

                <!-- Statistiques -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total des colis
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $totalPackages ?? '0' }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                En attente d'expédition
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $pendingPackages ?? '0' }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                En transit
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $inTransitPackages ?? '0' }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Livrés ce mois
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $deliveredThisMonth ?? '0' }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection