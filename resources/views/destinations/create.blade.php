@extends('layouts.app')

@section('header')
Ajouter des destinations
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('destinations.store') }}" id="destinations-form">
                    @csrf

                    <div id="destinations-container">
                        <!-- Template pour une destination -->
                        <div class="destination-item bg-gray-50 p-4 mb-6 rounded-lg border border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <!-- Pays -->
                                <div>
                                    <label for="country_0" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                                    <select name="destinations[0][country]" id="country_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                        @foreach($countries as $code => $country)
                                        <option value="{{  $country['name'] }}" @if ( $country['name']=='France' ) selected @endif>
                                            {{ $country['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Services -->
                                <div>
                                    <label for="compagny_0" class="block text-sm font-medium text-gray-700 mb-1">Entreprise</label>
                                    <select name="destinations[0][service_id]" id="compagny_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                        <option value="">Sélectionner un service</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                <!-- Jour de départ -->
                                <div>
                                    <label for="departure_date_0" class="block text-sm font-medium text-gray-700 mb-1">Jour de départ</label>
                                    <input type="date" name="destinations[0][departure_date]" id="departure_date_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                </div>

                                <!-- Jour d'arrivée -->
                                <div>
                                    <label for="arrival_date_0" class="block text-sm font-medium text-gray-700 mb-1">Jour d'arrivée</label>
                                    <input type="date" name="destinations[0][arrival_date]" id="arrival_date_0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                </div>

                                <!-- Nom du vol -->
                                <div>
                                    <label for="flight_0" class="block text-sm font-medium text-gray-700 mb-1">Nom du vol</label>
                                    <input type="text" name="destinations[0][flight_name]" id="flight_0" placeholder="ex: AIR FRANCE" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" class="remove-destination text-red-600 hover:text-red-800 font-medium text-sm" style="display: none;">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Supprimer cette destination
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton pour ajouter une nouvelle destination -->
                    <div class="mb-6">
                        <button type="button" id="add-destination" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter une destination
                        </button>
                    </div>

                    <!-- Bouton d'enregistrement -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Enregistrer toutes les destinations
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            let destinationsCount = 1;
            const container = document.getElementById('destinations-container');
            const template = container.querySelector('.destination-item');
            
            // Fonction pour ajouter une nouvelle destination
            document.getElementById('add-destination').addEventListener('click', function() {
                const newDestination = template.cloneNode(true);
                
                // Mise à jour des ID et names pour la nouvelle destination
                const inputs = newDestination.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const id = input.getAttribute('id');
                    
                    if (name) {
                        input.setAttribute('name', name.replace('[0]', '[' + destinationsCount + ']'));
                    }
                    
                    if (id) {
                        input.setAttribute('id', id.replace('_0', '_' + destinationsCount));
                    }
                    
                    // Réinitialiser les valeurs
                    input.value = '';
                });
                
                // Mettre à jour les labels
                const labels = newDestination.querySelectorAll('label');
                labels.forEach(label => {
                    const forAttr = label.getAttribute('for');
                    if (forAttr) {
                        label.setAttribute('for', forAttr.replace('_0', '_' + destinationsCount));
                    }
                });
                
                // Afficher le bouton de suppression
                const removeButton = newDestination.querySelector('.remove-destination');
                removeButton.style.display = 'inline-flex';
                
                // Ajouter l'événement de suppression
                removeButton.addEventListener('click', function() {
                    container.removeChild(newDestination);
                });
                
                // Ajouter au formulaire
                container.appendChild(newDestination);
                destinationsCount++;
                
                // Afficher le bouton de suppression pour la première destination si nous avons plus d'une destination
                if (destinationsCount > 1) {
                    container.querySelector('.destination-item .remove-destination').style.display = 'inline-flex';
                }
            });
            
            // Gérer la suppression pour la première destination
            const firstRemoveButton = template.querySelector('.remove-destination');
            firstRemoveButton.addEventListener('click', function() {
                if (container.querySelectorAll('.destination-item').length > 1) {
                    container.removeChild(template);
                }
            });
        });
    </script>
@endsection 