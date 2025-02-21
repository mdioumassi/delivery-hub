@extends('layouts.app')

@section('header')
Modification de colis
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">

    <form action="{{ route('packages.update', $package) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Package Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type de colis</label>
                <select id="type" name="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Sélectionner un type</option>
                    <option value="Medicament" {{ old('type', $package->type) == 'Medicament' ? 'selected' : '' }}>Medicament</option>
                    <option value="Valise" {{ old('type', $package->type) == 'Valise' ? 'selected' : '' }}>Valise</option>
                    <option value="Document" {{ old('type', $package->type) == 'Document' ? 'selected' : '' }}>Docuement</option>
                    <option value="Autre" {{ old('type', $package->type) == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Weight -->
            <div>
                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                <div class="relative">
                    <input type="number" step="0.01" id="weight" name="weight" value="{{ $package->weight }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pr-8">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                        kg
                    </div>
                </div>
                @error('weight')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Unit Price -->
            <div>
                <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                <input type="number" step="0.01" id="unit_price" name="unit_price" value="{{ $package->unit_price }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('unit_price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Service -->
            <div>
                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                <select id="service_id" name="service_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Sélectionner un service</option>
                    @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $package->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->type }}
                    </option>
                    @endforeach
                </select>
                @error('service_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sender -->
            <div>
                <label for="sender_id" class="block text-sm font-medium text-gray-700 mb-1">Sender</label>
                <div class="flex">
                    <select id="sender_id" name="sender_id" class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>Expéditeur</option>
                        @foreach($senders as $sender)
                        <option value="{{ $sender->id }}" {{ $package->sender_id == $sender->id ? 'selected' : '' }}>
                            {{ $sender->name }}
                        </option>
                        @endforeach
                    </select>
                    <a href="{{ route('packages.create') }}" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                @error('sender_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Recipient -->
            <div>
                <label for="recipient_id" class="block text-sm font-medium text-gray-700 mb-1">Recipient</label>
                <div class="flex">
                    <select id="recipient_id" name="recipient_id" class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>Récepteur</option>
                        @foreach($recipients as $recipient)
                        <option value="{{ $recipient->id }}" {{ $package->recipient_id == $recipient->id ? 'selected' : '' }}>
                            {{ $recipient->name }}
                        </option>
                        @endforeach
                    </select>
                    <a href="{{ route('packages.create') }}" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                @error('recipient_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Departure Date -->
            <!-- <div>
                <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-1">Departure Date</label>
                <input type="date" id="departure_date" name="departure_date" value="{{ $package->departure_date ? date('Y-m-d', strtotime($package->departure_date)) : '' }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('departure_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="created" {{ request('status') == 'created' ? 'selected' : '' }}>Créé</option>
                    <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Traité</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Expédié</option>
                    <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>En transit</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Livré</option>
                </select>
            </div>

        </div>

        <div class="flex space-x-4 pt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Modifié le colis
            </button>
            <a href="{{ route('packages.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection