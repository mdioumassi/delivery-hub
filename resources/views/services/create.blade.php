@extends('layouts.app')

@section('header')
Créer un service
@endsection

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Créer un service</h1>
        </div>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de service</label>
                            <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Sélectionner un service</option>    
                            @foreach($servicetypes as $type)
                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="company_id" class="block text-sm font-medium text-gray-700">Entreprise</label>
                            <select id="company_id" name="company_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Sélectionner une entreprise</option>   
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Actif</label>
                            <select id="is_active" name="is_active" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="1">Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Destinations Section -->
                    <div class="mt-8 border border-gray-200 rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Destinations</h3>
                        </div>

                        <div id="destinations-container">
                            <div class="destination-item mb-6 pb-6 border-b border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="destinations[0][country]" class="block text-sm font-medium text-gray-700">Pays de destination</label>
                                        <select id="destinations[0][country]" name="destinations[0][country]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            @foreach($countries as $code => $country)
                                            <option value="{{  $country['name'] }}" @if ( $country['name']=='France' ) selected @endif>
                                                {{ $country['name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                    <div>
                                        <label for="destinations[0][departure_date]" class="block text-sm font-medium text-gray-700">Jour de départ</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input type="date" id="destinations[0][departure_date]" name="destinations[0][departure_date]" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="destinations[0][arrival_date]" class="block text-sm font-medium text-gray-700">Jour d'arrivée</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <input type="date" id="destinations[0][arrival_date]" name="destinations[0][arrival_date]" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="destinations[0][flight_name]" class="block text-sm font-medium text-gray-700">Moyen de destination</label>
                                        <select id="destinations[0][flight_name]" name="destinations[0][flight_name]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Sélectionner un moyen de destination</option>
                                            <option value="avion">Par Avion</option>
                                            <option value="bateau">Par bateau</option>
                                            <option value="route">Par la route</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-destination" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajouter une destination
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Créer un service
                    </button>

                    <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Annuler
                    </a>
                </div>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Enregistrer toutes les destinations
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addDestinationButton = document.getElementById('add-destination');
        const destinationsContainer = document.getElementById('destinations-container');
        let destinationIndex = 0;

        addDestinationButton.addEventListener('click', function() {
            destinationIndex++;

            const template = `
                    <div class="destination-item mb-6 pb-6 border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="destinations[${destinationIndex}][country]" class="block text-sm font-medium text-gray-700">Pays de destination</label>
                                <select id="destinations[${destinationIndex}][country]" name="destinations[${destinationIndex}][country]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach($countries as $code => $country)
                                        <option value="{{  $country['name'] }}" @if ( $country['name']=='France' ) selected @endif>
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div>
                                <label for="destinations[${destinationIndex}][departure_date]" class="block text-sm font-medium text-gray-700">Jour de départ</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="date" id="destinations[${destinationIndex}][departure_date]" name="destinations[${destinationIndex}][departure_date]" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            
                            <div>
                                <label for="destinations[${destinationIndex}][arrival_date]" class="block text-sm font-medium text-gray-700">Jour d'arrivée</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="date" id="destinations[${destinationIndex}][arrival_date]" name="destinations[${destinationIndex}][arrival_date]" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                            
                            <div>
                                <label for="destinations[${destinationIndex}][flight_name]" class="block text-sm font-medium text-gray-700">Moyen de destination</label>
                                <select id="destinations[${destinationIndex}][flight_name]" name="destinations[${destinationIndex}][flight_name]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionner un moyen de destination</option>
                                                <option value="avion">Par Avion</option>
                                        <option value="bateau">Par bateau</option>
                                        <option value="route">Par la route</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            <button type="button" class="remove-destination text-sm text-red-600 hover:text-red-800">
                                Supprimer cette destination
                            </button>
                        </div>
                    </div>
                `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = template;
            const newDestination = tempDiv.firstElementChild;

            destinationsContainer.appendChild(newDestination);

            // Add event listener to the remove button
            newDestination.querySelector('.remove-destination').addEventListener('click', function() {
                newDestination.remove();
            });
        });
    });
</script>
@endsection