@extends('layouts.app')

@section('header')
Détails de la personne
@endsection

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Détails de la personne</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('persons.edit', $person) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('persons.destroy', $person) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette personne?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informations personnelles -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Informations personnelles</h2>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Civilité</p>
                                        <p class="mt-1">{{ $person->civility ?? 'Non spécifié' }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Type</p>
                                        <p class="mt-1">{{ $person->type }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                    <p class="mt-1">{{ $person->fullname }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="mt-1">{{ $person->user->email }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Téléphone</p>
                                    <p class="mt-1">{{ $person->phone ?? 'Non spécifié' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date de création</p>
                                    <p class="mt-1">{{ $person->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            
                            <!-- Adresse -->
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Adresse</h2>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Rue</p>
                                    <p class="mt-1">{{ $person->street ?? 'Non spécifié' }}</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Ville</p>
                                        <p class="mt-1">{{ $person->city ?? 'Non spécifié' }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Code postal</p>
                                        <p class="mt-1">{{ $person->zip_code ?? 'Non spécifié' }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pays</p>
                                    <p class="mt-1">{{ $person->country ?? 'Non spécifié' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informations supplémentaires -->
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Informations supplémentaires</h2>
                            
                            @if($person->notes)
                                <div class="bg-white p-4 rounded shadow-sm">
                                    <p class="text-sm font-medium text-gray-500 mb-2">Notes</p>
                                    <p class="whitespace-pre-line">{{ $person->notes }}</p>
                                </div>
                            @else
                                <div class="bg-white p-4 rounded shadow-sm">
                                    <p class="text-gray-500 italic">Aucune information supplémentaire</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('persons.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Retour à la liste des personnes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection