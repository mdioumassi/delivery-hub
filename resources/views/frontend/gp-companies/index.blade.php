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
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-700 mb-2">Destinations desservies <i class="fa-solid fa-plane-departure"></i></h3>
                        @if($company->services && $company->services->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($company->services as $service)
                                @foreach($service->destinations as $destination)
                                    @if ($destination->country)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $destination->country }}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <p class="text-sm text-gray-500">Aucun pays desservies</p>
                                    </span>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <ul class="space-y-2 list-disc list-inside">
                            <h3 class="font-medium text-gray-700 mb-2">Téléphone </h3>
                            <li class="text-gray-700 ml-5"><i class="fa-solid fa-phone-volume"></i> : {{ $company->phone_fixe }}</li>
                            <li class="text-gray-700 ml-5"><i class="fa-regular fa-mobile-screen-button"></i> : {{ $company->phone_mobile }}</li>
                            <li class="text-gray-700 ml-5"><i class="fa-brands fa-whatsapp"></i> : {{ $company->phone_whatsapp }}</li>
                        </ul>
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