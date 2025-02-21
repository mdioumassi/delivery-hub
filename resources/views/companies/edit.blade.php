@extends('layouts.app')

@section('header')
Modifier une entreprise
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Modifier l'company</h2>
                    <p class="text-gray-600">Modifiez les informations de l'company {{ $company->nom }}</p>
                </div> -->

                <form method="POST" action="{{ route('companies.update', $company) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom de l'company -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'entreprise</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div class="md:col-span-2">
                            <label for="street" class="block text-sm font-medium text-gray-700">Rue</label>
                            <input type="text" name="street" id="adresse" value="{{ old('street', $company->street) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('street')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $company->city) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Code postal -->
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $company->zip_code) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('zip_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pays -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                            <select name="country" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach($countries as $code => $country)
                                <option value="{{  $country['name'] }}" {{ $company->country == $country['name'] ? 'selected' : '' }}>{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone_fixe" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="tel" name="phone_fixe" id="phone_fixe" value="{{ old('phone_fixe', $company->phone_fixe) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('phone_fixe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Portable -->
                        <div>
                            <label for="phone_mobile" class="block text-sm font-medium text-gray-700">Portable</label>
                            <input type="tel" name="phone_mobile" id="phone_mobile" value="{{ old('phone_mobile', $company->phone_mobile) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('phone_mobile')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Numéro WhatsApp -->
                        <div>
                            <label for="phone_whatsapp" class="block text-sm font-medium text-gray-700">Numéro WhatsApp</label>
                            <input type="tel" name="phone_whatsapp" id="phone_whatsapp" value="{{ old('phone_whatsapp', $company->phone_whatsapp) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('phone_whatsapp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SIRET -->
                        <div>
                            <label for="siret" class="block text-sm font-medium text-gray-700">SIRET</label>
                            <input type="text" name="siret" id="siret" value="{{ old('siret', $company->siret) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('siret')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gestionnaire -->
                        <div>
                            <label for="gestionnaire_id" class="block text-sm font-medium text-gray-700">Gestionnaire</label>
                            <select name="gestionnaire_id" id="gestionnaire_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Sélectionner un gestionnaire</option>
                                @foreach($gestionnaires as $gestionnaire)
                                <option value="{{ $gestionnaire->id }}"
                                    {{ old('gestionnaire_id', $company->gestionnaire_id) == $gestionnaire->id ? 'selected' : '' }}>
                                    {{ $gestionnaire->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('gestionnaire_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('companies.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection