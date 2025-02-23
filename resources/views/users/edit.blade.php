{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
<!-- <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>

        <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-3 gap-6">
            {{-- Civilité Section --}}
            <div class="mb-4">
                <label for="civilite" class="block text-gray-700 text-sm font-bold mb-2">Civilité</label>
                <select name="civility" id="civility" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Monsieur" {{ $user->civility == 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                    <option value="Madame" {{ $user->Madame == 'Madame' ? 'selected' : '' }}>Madame</option>
                </select>
            </div>

            {{-- Type d'utilisateur Section --}}
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type d'utilisateur</label>
                <select name="type" id="type" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Admin" {{ $user->type == 'Expéditeur' ? 'selected' : '' }}>Expéditeur</option>
                    <option value="User" {{ $user->type == 'Récepteur' ? 'selected' : '' }}>Récepteur</option>
                    <option value="Manager" {{ $user->type == 'Gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                </select>
            </div>

            {{-- Email Section --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->email }}">
            </div>

            {{-- Mot de passe Section --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            {{-- Nom complet Section --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom complet</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->name }}">
            </div>

            {{-- Téléphone Section --}}
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->phone }}">
            </div>

            {{-- Adresse Section --}}
            <div class="mb-4">
                <label for="street" class="block text-gray-700 text-sm font-bold mb-2">Rue</label>
                <input type="text" name="street" id="street" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->street }}">
            </div>

            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
                <input type="text" name="city" id="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->city }}">
            </div>

            <div class="mb-4">
                <label for="zip_code" class="block text-gray-700 text-sm font-bold mb-2">Code postal</label>
                <input type="text" name="zip_code" id="zip_code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->zip_code }}">
            </div>

            <div class="mb-4">
                <label for="pays" class="block text-gray-700 text-sm font-bold mb-2">Pays</label>
                <select name="country" id="country" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($countries as $code => $country)
                    <option value="{{  $country['name'] }}" {{ $user->country == $code ? 'selected' : '' }}>{{ $country['name'] }}</option>
                @endforeach    
                <option value="France" {{ $user->country == 'France' ? 'selected' : '' }}>France</option>
                </select>
            </div>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Mettre à jour
                </button>
            </div>

        </form>
    </div> -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>

                <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Civilité -->
                        <div>
                            <label for="civility" class="block text-sm font-medium text-gray-700 mb-1">Civilité</label>
                            <select id="civility" name="civility" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner une civilité</option>
                                <option value="Monsieur" {{ $user->civility == 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                                <option value="Madame" {{ $user->civility == 'Madame' ? 'selected' : '' }}>Madame</option>
                            </select>
                        </div>

                        <!-- Type utilisateur -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type utilisateur</label>
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner un type</option>
                                <option value="{{ $user->type }}" {{ $user->type == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="{{ $user->type }}" {{ $user->type == 'Expéditeur' ? 'selected' : '' }}>Expéditeur</option>
                                <option value="{{ $user->type }}" {{ $user->type == 'Récepteur' ? 'selected' : '' }}>Récepteur</option>
                                <option value="{{ $user->type }}" {{ $user->type == 'Gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Mot de passe
                                <span class="text-xs text-gray-500">(Laisser vide pour conserver l'actuel)</span>
                            </label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ $user->password }}">
                            @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nom complet -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rue -->
                        <div>
                            <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Rue</label>
                            <input type="text" name="street" id="street" value="{{ $user->street }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('street')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                            <input type="text" name="city" id="city" value="{{ $user->city }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Code postal -->
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ $user->zip_code }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('zip_code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pays -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                            <select id="country" name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($countries as $code => $country)
                                <option value="{{  $country['name'] }}" {{ $user->country == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Annuler
                        </a>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection