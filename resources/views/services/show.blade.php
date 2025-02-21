@extends('layouts.app')

@section('header')
Détails du service
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Détails du service</h2>
                        <div class="flex space-x-3">
                            <a href="{{ route('services.edit', $service->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150">
                                Modifier
                            </a>
                            <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Retour à la liste
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- ID et statut -->
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">ID du service</h3>
                                    <p class="mt-1 text-sm text-gray-900">{{ $service->id }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Statut</h3>
                                    <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Date de création -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Créé le</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            
                            <!-- Type de service -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Type de service</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->type ?? 'Non défini' }}</p>
                            </div>

                            <!-- Entreprise -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Entreprise</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $service->company->name ?? 'Non définie' }}</p>
                            </div>

                            <!-- Description (pleine largeur) -->
                            <div class="md:col-span-2">
                                <h3 class="text-sm font-medium text-gray-500">Description</h3>
                                <div class="mt-1 p-3 bg-white rounded-md border border-gray-200 min-h-[100px]">
                                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $service->description ?: 'Aucune description fournie.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information de mise à jour -->
                    <div class="mt-6 pt-5 border-t border-gray-200">
                        <div class="flex justify-between text-xs text-gray-500">
                            <p>Dernière mise à jour: {{ $service->updated_at->format('d/m/Y à H:i') }}</p>
                            <p>Par: {{ $service->updatedBy->name ?? 'Système' }}</p>
                        </div>
                    </div>

                    <!-- Actions supplémentaires -->
                    <div class="mt-8 border-t border-gray-200 pt-5">
                        <div class="flex justify-end">
                            <form method="POST" action="{{ route('services.destroy', $service->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:shadow-outline-red transition ease-in-out duration-150">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection