<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mon Site</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <!-- Barre de Navigation (identique aux templates précédents) -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <span class="text-2xl font-bold text-blue-600">Logo</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{route('login')}}" class="px-5 py-2 text-gray-600 hover:text-blue-500 transition duration-300">
                        Déjà membre ? Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Connexion -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Connectez-vous</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Ou <a href="#" class="text-blue-500 hover:text-blue-600 font-medium">créez un compte</a>
                </p>
            </div>
            <x-validation-errors class="mb-4" />
            @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
            @endsession

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="email@exemple.com">
                        <svg class="absolute right-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <input type="password"
                            name="password"
                            id="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="••••••••">
                        <button type="button" class="absolute right-3 top-3.5 text-gray-400 hover:text-blue-500" onclick="togglePassword()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-600">Mot de passe oublié ?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg transition duration-300 font-medium">
                    Se connecter
                </button>

                <!-- Social Login -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Ou continuer avec</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a href="#" class="flex items-center justify-center p-3 border rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-5 h-5" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                            </svg>
                        </a>
                        <a href="#" class="flex items-center justify-center p-3 border rounded-lg hover:bg-gray-50 transition">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.querySelector('input[type="password"]');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        }
    </script>
</body>

</html>