@extends('layouts.app')

@section('header')
    Destinations
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-end mb-4">
                <a href="{{ route('destinations.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Ajouter une destination
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pays
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jours de depart
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jous d'arrivée
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Entreprise
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($destinations as $destination)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $destination->country }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $destination->departure_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $destination->arrival_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $destination->company->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('destinations.edit', $destination) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                                    <form action="{{ route('destinations.destroy', $destination) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Êtes-vous sûr?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Afficher les liens de pagination --}}
        <div class="d-flex justify-content-center">
            {{ $destinations->links() }}
        </div>
    </div>
    </div>
    </div>
@endsection
