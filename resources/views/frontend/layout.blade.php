<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les GP de ile de France</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
        @yield('content')
    </div>
    @yield('scripts')
</body>

</html>