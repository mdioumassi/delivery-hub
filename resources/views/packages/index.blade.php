@extends('layouts.app')

@section('title', 'Liste des colis')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between">
        <h1 class="text-2xl font-bold">Liste des colis</h1>
        <a href="{{ route('packages.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Nouveau colis
        </a>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
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
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($packages as $package)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->weight }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->unit_price }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $package->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $package->status }}
                        </span>
                    </td>
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
</div>
@endsection