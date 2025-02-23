<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template avec Recherche et Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Barre de navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <span class="text-2xl font-bold text-blue-600">MonSite</span>
                </div>

                <!-- Barre de recherche -->
                <div class="flex-1 max-w-2xl mx-8">
                    <form class="relative">
                        <input type="text" 
                               placeholder="Rechercher..." 
                               class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <button type="submit" 
                                class="absolute right-3 top-2 text-gray-400 hover:text-blue-500">
                            🔍
                        </button>
                    </form>
                </div>

                <!-- Bouton Connexion -->
                <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-300">
                        Connexion
                    </a>
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
   
                </div>
            </div>
        </div>
    </nav>

 

    <!-- Footer simple -->
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>&copy; 2023 MonSite. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>