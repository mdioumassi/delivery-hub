<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Moderne avec Tailwind</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Barre de Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <span class="text-2xl font-bold text-blue-600">Logo</span>
                </div>

                <!-- Barre de Recherche Centrale (Desktop) -->
                <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                    <div class="relative w-full">
                        <input type="text"
                            placeholder="Rechercher..."
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <button class="absolute right-3 top-3 text-gray-400 hover:text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Boutons CTA -->

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('login')}}" class="px-5 py-2.5 text-gray-600 hover:text-blue-500 transition duration-300">
                            Connexion
                        </a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 shadow-lg hover:shadow-blue-200">
                            Inscription
                        </a>
                        @endif
                        @endauth
                    </nav>
                    @endif
                </div>
            </div>

            <!-- Barre de Recherche Mobile -->
            <div class="md:hidden py-4">
                <div class="relative">
                    <input type="text"
                        placeholder="Rechercher..."
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="absolute right-3 top-3 text-gray-400 hover:text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Principale en Haut -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Liste des entreprises et services</h1>
        <div class="grid gap-6 md:grid-cols-3">
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
                        @include('gp-companies._accordeon_service', ['service' => $service])
                        @endforeach
                        @else
                        <p class="text-sm text-gray-500">Aucun service disponible</p>
                        @endif
                    </div>
                    <!-- Destinations -->
                    <div class="mb-4">
                        <h3 class="font-medium text-gray-700 mb-2">Destinations desservies</h3>
                        @if($company->services && $company->services->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($company->services as $service)
                                    @foreach($service->destinations as $destination)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $destination->country }}
                                        </span>
                                    @endforeach
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Aucune destination disponible</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <ul class="space-y-2 list-disc list-inside">
                        <h3 class="font-medium text-gray-700 mb-2">Téléphone</h3>
                            <li class="text-gray-700 ml-5">Fixe: {{ $company->phone_fixe }}</li>
                            <li class="text-gray-700 ml-5">Mobile: {{ $company->phone_mobile }}</li>
                            <li class="text-gray-700 ml-5">Whatsapp: {{ $company->phone_whatsapp }}</li>
                        </ul>
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
</body>

</html>