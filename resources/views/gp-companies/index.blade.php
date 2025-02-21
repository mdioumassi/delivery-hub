
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Liste des entreprises et services</h1>
    
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($companies as $company)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $company->name }}</h2>
                </div>
                
                <div class="p-4">
                    <!-- Services -->
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-700 mb-2">Services disponibles</h3>
                        @if($company->services && $company->services->count() > 0)
                            <ul class="space-y-1 text-sm">
                                @foreach($company->services as $service)
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $service->type }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Aucun service disponible</p>
                        @endif
                    </div>
                    
                    <!-- Destinations -->
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-700 mb-2">Destinations desservies</h3>
                        @if($company->destinations && $company->destinations->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($company->destinations as $destination)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $destination->type }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Aucune destination disponible</p>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="mt-6 flex space-x-3">
                        <div class="dropdown relative">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="dropdown-{{ $company->id }}">
                                Envoyer
                                <svg class="w-4 h-4 ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="dropdown-menu hidden absolute z-10 mt-1 bg-white shadow-lg rounded-md w-48" id="dropdown-menu-{{ $company->id }}">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Envoyer un colis
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Envoyer un conteneur
                                </a>
                            </div>
                        </div>
                        
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Suivre les envois
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Toggle dropdown menus
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('[id^="dropdown-"]:not([id^="dropdown-menu-"])');
        
        dropdowns.forEach(dropdown => {
            const id = dropdown.id.split('-')[1];
            const menu = document.getElementById(`dropdown-menu-${id}`);
            
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
        });
        
        document.addEventListener('click', function() {
            document.querySelectorAll('[id^="dropdown-menu-"]').forEach(menu => {
                menu.classList.add('hidden');
            });
        });
    });
</script>
@endsection