@extends('layouts.app')

@section('header')
Créer un utilisateur
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-3 gap-6">
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                    <input type="text" name="name" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-3">
                    <label for="street" class="block text-sm font-medium text-gray-700">Rue</label>
                    <input type="text" name="street" id="street" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>
                <!-- <div class="grid grid-cols-3 gap-4"> -->
                <div class="mb-3">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-3">
                    <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select name="country" id="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($countries as $code => $country)
                        <option value="{{ $country['name'] }}" @if ( $country['name']== 'France') selected @endif>
                            {{ $country['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postale</label>
                    <input type="text" name="zip_code" id="zip_code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="mb-3">
                    <label for="phone_fixe" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="phone_fixe" id="phone_fixe" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>


                <div class="mb-3">
                    <label for="phone_mobile" class="block text-sm font-medium text-gray-700">Portable</label>
                    <input type="text" name="phone_mobile" id="phone_mobile" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-3">
                    <label for="phone_whatsapp" class="block text-sm font-medium text-gray-700">Numéro whatsapp</label>
                    <input type="text" name="phone_whatsapp" id="phone_whatsapp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-3">
                    <label for="siret" class="block text-sm font-medium text-gray-700">SIRET</label>
                    <input type="text" name="siret" id="siret" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-3">
                    <label for="gestionnaire" class="block text-sm font-medium text-gray-700">Gestionnaire</label>
                    <select name="gestionnaire_id" id="gestionnaire" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Sélectionner un gestionnaire</option>
                        @foreach($gestionnaires as $gestionnaire)
                        <option value="{{ $gestionnaire->id }}">{{ $gestionnaire->name }}</option>
                        @endforeach 
                    </select>
                </div>
            </div>


            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer une entreprise
                </button>
                <a href="{{ route('packages.index') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection