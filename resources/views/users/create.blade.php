@extends('layouts.app')

@section('header')
Créer un utilisateur
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Créer un utilisateur</h1>

                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Civilité -->
                        <div>
                            <label for="civility" class="block text-sm font-medium text-gray-700 mb-1">Civilité</label>
                            <select id="civility" name="civility" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner une civilité</option>
                                <option value="monsieur">Monsieur</option>
                                <option value="madame">Madame</option>
                            </select>
                        </div>

                        <!-- Type utilisateur -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type utilisateur</label>
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner un type</option>
                                <option value="Expéditeur">Expéditeiur</option>
                                <option value="Récepteur">Récepteur</option>
                                <option value="Gestionnaire">Gestionnaire</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <!-- Nom complet -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Rue -->
                        <div>
                            <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Rue</label>
                            <input type="text" name="street" id="street" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Ville -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                            <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Code postal -->
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                            <input type="text" name="zip_code" id="zip_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Pays -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                            <select id="country" name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner un pays</option>
                                @foreach($countries as $code => $country)
                                <option value="{{ $country['name'] }}" @if ($code=='fr' ) selected @endif>{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Créer l'utilisateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection