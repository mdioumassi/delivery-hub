@extends('layouts.app')

@section('header')
Utilisateurs
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Liste des utilisateurs</h1>
                    <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Nouvel utilisateur
                    </a>
                </div>

                <!-- Filtres et recherche -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <form action="{{ route('users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                            
                            <a href="{{ route('users.index') }}" class="w-full ml-4 bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Réinitialiser</a>
                        </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Messages de notification -->
        @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <!-- Tableau des utilisateurs -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="py-3 px-4 text-left">Nom</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Type</th>
                        <th class="py-3 px-4 text-left">Téléphone</th>
                        <th class="py-3 px-4 text-left">Ville</th>
                        <th class="py-3 px-4 text-left">Date de création</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-800 font-bold mr-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->user_type == 'admin' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $user->user_type == 'client' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $user->user_type == 'employee' ? 'bg-blue-100 text-blue-800' : '' }}">
                                {{ ucfirst($user->type) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $user->phone ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $user->city ?? '-' }}</td>
                        <td class="py-3 px-4">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:text-blue-900" title="Voir">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-900" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
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
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
</div>
</div>
@endsection