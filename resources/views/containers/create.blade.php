@extends('layouts.app')

@section('title', 'Nouveau conteneur')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-bold">Nouveau conteneur</h1>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('containers.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="standard">Standard</option>
                        <option value="refrigerated">Réfrigéré</option>
                        <option value="dangerous">Matières dangereuses</option>
                    </select>
                    @error('type')
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

                <div class="col-span-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" 
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
                    <select id="service_id" name="service_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->type }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer le conteneur
                </button>
                <a href="{{ route('containers.index') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection