@extends('frontend.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6">Liste des entreprises et services</h1>
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach($companies as $company)
    <div class="bg-white rounded-lg shadow-md overflow-hidden mx-auto">
        <div class="bg-indigo-200 px-4 py-3 border-b">
            <h2 class="text-xl font-semibold text-gray-800">
                <a href="{{ route('gp-companies.show', $company->id) }}">{{ $company->name }}</a>
            </h2>
            <span>{{ $company->country }}</span>
        </div>

        <div class="p-4">
            <!-- Services -->
            <div class="mb-4">
                <h3 class="font-medium text-gray-700 mb-2">Nos services & prochains departs</h3>
                @if($company->services && $company->services->count() > 0)
                @foreach($company->services as $service)
                @include('frontend/gp-companies._accordeon_service', ['service' => $service])
                @endforeach
                @else
                <p class="text-sm text-gray-500">Aucun service disponible</p>
                @endif
            </div>
            <!-- Destinations -->
            <!-- <div class="mb-6">
                @if($company->services && $company->services->count() > 0)
                    @php
                    // Regrouper les destinations par type de vol/service
                    $destinationsByFlightType = [];
                    foreach($company->services as $service) {
                        foreach($service->destinations as $destination) {
                            if (!isset($destinationsByFlightType[$destination->flight_name])) {
                                $destinationsByFlightType[$destination->flight_name] = [];
                            }

                            if ($destination->country && !in_array($destination->country, $destinationsByFlightType[$destination->flight_name])) {
                                $destinationsByFlightType[$destination->flight_name][] = $destination->country;
                            }
                    }
                }
                @endphp
                @foreach($destinationsByFlightType as $flightName => $countries)
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-700 mb-2">
                            Destinations desservies par {{ $flightName = 'par avion' ? '<i class="fa-solid fa-plane-departure"></i>' : '' }}
                            {{ $flightName }}
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($countries as $country)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $country }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                @else
                <p class="text-gray-500">Aucune destination disponible.</p>
                @endif
            </div> -->
            <!-- Destinations -->
            <div class="mb-6">
                @if($company->services && $company->services->count() > 0)
                @php
                // Regrouper les destinations par type de vol/service
                $destinationsByFlightType = [];

                foreach($company->services as $service) {
                foreach($service->destinations as $destination) {
                if (!isset($destinationsByFlightType[$destination->flight_name])) {
                $destinationsByFlightType[$destination->flight_name] = [];
                }

                if ($destination->country && !in_array($destination->country, $destinationsByFlightType[$destination->flight_name])) {
                $destinationsByFlightType[$destination->flight_name][] = $destination->country;
                }
                }
                }

                // Définir les icônes et couleurs par type de service
                $serviceIcons = [
                'avion' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="h-5 w-5 mr-2">
                    <path d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2l137.7 0c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48l-57.4 0c-20.2 0-40.2 4.8-58.2 14L381 114.9zM0 480c0 17.7 14.3 32 32 32l576 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L32 448c-17.7 0-32 14.3-32 32z" />
                </svg>',
                'bateau' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-5 w-5 mr-2">
                    <path d="M256 16c0-7 4.5-13.2 11.2-15.3s13.9 .4 17.9 6.1l224 320c3.4 4.9 3.8 11.3 1.1 16.6s-8.2 8.6-14.2 8.6l-224 0c-8.8 0-16-7.2-16-16l0-320zM212.1 96.5c7 1.9 11.9 8.2 11.9 15.5l0 224c0 8.8-7.2 16-16 16L80 352c-5.7 0-11-3-13.8-8s-2.9-11-.1-16l128-224c3.6-6.3 11-9.4 18-7.5zM5.7 404.3C2.8 394.1 10.5 384 21.1 384l533.8 0c10.6 0 18.3 10.1 15.4 20.3l-4 14.3C550.7 473.9 500.4 512 443 512L133 512C75.6 512 25.3 473.9 9.7 418.7l-4-14.3z" />
                </svg>',
                'route' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-5 w-5 mr-2">
                    <path d="M256 32l-74.8 0c-27.1 0-51.3 17.1-60.3 42.6L3.1 407.2C1.1 413 0 419.2 0 425.4C0 455.5 24.5 480 54.6 480L256 480l0-64c0-17.7 14.3-32 32-32s32 14.3 32 32l0 64 201.4 0c30.2 0 54.6-24.5 54.6-54.6c0-6.2-1.1-12.4-3.1-18.2L455.1 74.6C446 49.1 421.9 32 394.8 32L320 32l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64zm64 192l0 64c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32s32 14.3 32 32z" />
                </svg>'
                ];

                $serviceColors = [
                'avion' => 'bg-blue-100 text-blue-800',
                'bateau' => 'bg-indigo-100 text-indigo-800',
                'route' => 'bg-green-100 text-green-800'
                ];
                @endphp

                @foreach($destinationsByFlightType as $flightName => $countries)
                <div class="mb-4">
                    @php
                    $iconKey = Str::contains(strtolower($flightName), 'avion') ? 'avion' :
                    (Str::contains(strtolower($flightName), 'bateau') ? 'bateau' :
                    (Str::contains(strtolower($flightName), 'route') ? 'route' : 'avion'));

                    $colorClass = $serviceColors[$iconKey] ?? 'bg-blue-100 text-blue-800';
                    @endphp

                    <h3 class="font-medium text-gray-700 mb-2 flex items-center">
                        {!! $serviceIcons[$iconKey] ?? '' !!}
                        Destinations desservies par {{ $flightName }}
                    </h3>

                    <div class="flex flex-wrap gap-2 ml-7">
                        @foreach($countries as $country)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                            {{ $country }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-gray-500">Aucune destination disponible.</p>
                @endif
            </div>

            <div class="mb-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
            <h3 class="font-medium text-gray-800">Téléphone</h3>
        </div>
        
        <div class="p-4">
            <ul class="space-y-3">
                @if($company->phone_fixe)
                    <li class="flex items-center text-gray-700">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-blue-50 text-blue-500">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <span class="ml-3">{{ $company->phone_fixe }}</span>
                    </li>
                @endif
                
                @if($company->phone_mobile)
                    <li class="flex items-center text-gray-700">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-green-50 text-green-500">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <span class="ml-3">{{ $company->phone_mobile }}</span>
                    </li>
                @endif
                
                @if($company->phone_whatsapp)
                    <li class="flex items-center text-gray-700">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-green-50 text-green-600">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <span class="ml-3">{{ $company->phone_whatsapp }}</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
            <!-- Actions -->
            <div class="mt-6 flex space-x-3">
                <div class="dropdown relative">
                    <a href="{{ route('gp-companies.show', $company->id) }}">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="dropdown-{{ $company->id }}">
                            Envoyer
                            <svg class="w-4 h-4 ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </a>
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
@endsection
@section('scripts')
<script>
    document.querySelectorAll('.accordion-btn').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const isOpen = content.style.maxHeight;

            // Fermer tous les autres
            document.querySelectorAll('.accordion-content').forEach(item => {
                item.style.maxHeight = null;
            });

            // Toggle l'état actuel
            if (!isOpen || isOpen === '0px') {
                content.style.maxHeight = content.scrollHeight + 'px';
            } else {
                content.style.maxHeight = null;
            }
        });
    });
</script>
@endsection