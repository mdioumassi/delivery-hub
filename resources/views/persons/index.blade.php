@extends('layouts.app')

@section('header')
Liste des utilisateurs
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-end items-center mb-6">
                    <a href="{{ route('persons.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Nouvel utilisateur
                    </a>
                </div>

                <!-- Filtres et recherche -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <form action="{{ route('persons.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nom ou email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type d'utilisateur</label>
                            <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Tous les types</option>
                                <option value="Expéditeur">Expéditeiur</option>
                                <option value="Récepteur">Récepteur</option>
                                <option value="Gestionnaire">Gestionnaire</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                            <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom (Z-A)</option>
                                <option value="created_desc" {{ request('sort') == 'created_desc' || !request('sort') ? 'selected' : '' }}>Plus récent</option>
                                <option value="created_asc" {{ request('sort') == 'created_asc' ? 'selected' : '' }}>Plus ancien</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Filtrer
                            </button>
                            
                            <a href="{{ route('persons.index') }}" class="w-full ml-4 bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Réinitialiser</a>
                        </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                       
                        <th class="py-3 px-4 text-left">Nom</th>
                        <th class="py-3 px-4 text-left">Civilité</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Profil</th>
                        <th class="py-3 px-4 text-left">Téléphone</th>
                        <th class="py-3 px-4 text-left">Localisation</th>
                        <th class="py-3 px-4 text-left">Date de création</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($persons as $person)
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-800 font-bold mr-3">
                                    {{ substr($person->fullname, 0, 1) }}
                                </div>
                                {{ $person->fullname }}
                            </div>
                        </td>
                        <td class="py-3 px-4">{{ $person->civility }}</td>
                        <td class="py-3 px-4">{{ $person->user->email }}</td>
                        <td class="py-3 px-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $person->type == 'admin' ? 'bg-blue-100 text-blue-800' : 
                                       ($person->type == 'gestionnaire' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $person->type }}
                                </span>
                        </td>
                        <td class="py-3 px-4">{{ $person->phone ?? '-' }}</td>
                        <td class="py-3 px-4"> {{ $person->city }}, {{ $person->country }}</td>
                        <td class="py-3 px-4">{{ $person->created_at->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('persons.show', $person) }}" class="text-blue-600 hover:text-blue-900" title="Voir">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('persons.edit', $person) }}" class="text-yellow-600 hover:text-yellow-900" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('persons.destroy', $person) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $persons->withQueryString()->links() }}
        </div>
    </div>
</div>
</div>
</div>
@endsection