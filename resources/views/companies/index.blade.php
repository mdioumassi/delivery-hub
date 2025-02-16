@extends('layouts.app')

@section('header')
    Entreprises
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-end mb-4">
                <a href="{{ route('companies.create') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Ajouter une entreprise
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ville
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gestionnaire</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($companies as $company)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $company->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $company->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $company->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $company->city }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $company->country }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                                        class="text-indigo-600">{{ $company->getGestionnaireNameAttribute() }}</a></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('companies.edit', $company) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-heart text-4xl text-red-500"></i>Modifier</a>
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline">
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
                {{-- Afficher les liens de pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
