@extends('layouts.app')

@section('header')
    Créer un utilisateur
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                    <select name="civility" id="civility" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    ">
                        <option value="">Sélectionner une civilite</option>
                        <option value="Monsieur">Monsieur</option>
                        <option value="Madame">Madame</option>
                    </select>
                    @error('civility')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type utilisateur</label>
                    <select name="type" id="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    ">
                        <option value="">Sélectionner un type</option>
                        <option value="Expéditeur">Expéditeiur</option>
                        <option value="Récepteur">Récepteur</option>
                        <option value="Gestionnaire">Gestionnaire</option>
                    </select>
                    @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="street" class="block text-sm font-medium text-gray-700">Rue</label>
                    <input type="text" name="street" id="street" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                    <input type="text" name="zip_code" id="zip_code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select name="country" id="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    ">
                        <option value="">Sélectionner un pays</option>
                        @foreach($countries as $code => $country)
                        <option value="{{ $code }}" @if ($code == 'fr') selected @endif>{{ $country['name'] }}</option>
                        @endforeach
                    </select>
                    @error('country')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection