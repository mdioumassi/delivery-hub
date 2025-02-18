// resources/views/packages/create.blade.php
@extends('layouts.app')

@section('header')
Créer un envoi de colis
@endsection

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de colis</label>
                    <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Sélectionner un type</option>
                        <option value="medicament">Meicament</option>
                        <option value="valise">Valise</option>
                        <option value="document">Docuement</option>
                        <option value="autre">Autre</option>
                    </select>
                    @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="weight" class="block text-sm font-medium text-gray-700">Poids</label>
                    <div class="relative">
                        <input type="text" name="weight" id="weight"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('weight') }}">
                        <span class="absolute right-3 top-2 text-gray-400">
                            kg
                        </span>
                    </div>
                    @error('weight')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="unit_price" class="block text-sm font-medium text-gray-700">Prix unitaire</label>
                    <input type="number" step="0.01" name="unit_price" id="unit_price"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('unit_price') }}">
                    @error('unit_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                    <select id="service_id" name="service_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->type }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="sender_id" class="block text-sm font-medium text-gray-700">Expéditeur</label>
                    <select id="sender_id" name="sender_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Sélectionner un expéditeur</option>
                        @foreach($senders as $sender)
                        <option value="{{ $sender->id }}">{{ $sender->name }}</option>
                        @endforeach
                    </select>
                    @error('sender_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="recipient_id" class="block text-sm font-medium text-gray-700">Récepteur</label>
                    <select id="recipient_id" name="recipient_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Sélectionner un récepteur</option>
                        @foreach($recipients as $recipient)
                        <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                        @endforeach
                    </select>
                    @error('recepteur_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer le colis
                </button>
                <a href="{{ route('packages.index') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection