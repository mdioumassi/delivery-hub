@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Détails de l'entreprise</h2>
                        <div class="flex space-x-3">
                            <a href="{{ route('companies.edit', $company->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('companies.destroy', $company->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise?')"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-700 mb-2">Informations générales</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Nom de l'entreprise</span>
                                    <span class="block mt-1">{{ $company->name }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Email</span>
                                    <span class="block mt-1">{{ $company->email }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">SIRET</span>
                                    <span class="block mt-1">{{ $company->siret }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Gestionnaire</span>
                                    <span class="block mt-1">{{ $company->gestionnaire ? $company->gestionnaire->nom : 'Non assigné' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-700 mb-2">Adresse</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Rue</span>
                                    <span class="block mt-1">{{ $company->street }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Ville</span>
                                    <span class="block mt-1">{{ $company->city }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Code postal</span>
                                    <span class="block mt-1">{{ $company->zip_code }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Pays</span>
                                    <span class="block mt-1">{{ $company->country }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-700 mb-2">Contact</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Téléphone</span>
                                    <span class="block mt-1">{{ $company->phone_fixe }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Portable</span>
                                    <span class="block mt-1">{{ $company->phone_mobile }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">WhatsApp</span>
                                    <span class="block mt-1">{{ $company->phone_whatsapp }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-700 mb-2">Historique</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Créé le</span>
                                    <span class="block mt-1">{{ $company->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Dernière modification</span>
                                    <span class="block mt-1">{{ $company->updated_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('companies.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Retour à la liste des companies
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection