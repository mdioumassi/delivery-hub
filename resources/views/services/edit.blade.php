@extends('layouts.app')

@section('header')
Modifier un service
@endsection

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('services.update', $service->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Type de service -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type de service</label>
                                <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled {{ old('type', $service->type) ? '' : 'selected' }}>Sélectionner un type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->value }}" {{ old('type', $service->type) == $type->value ? 'selected' : '' }}>
                                            {{ $type->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Entreprise -->
                            <div>
                                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Entreprise</label>
                                <select id="company" name="company_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled {{ old('company_id', $service->compagny_id) ? '' : 'selected' }}>Sélectionner une entreprise</option>
                                    @foreach($companies as $compagny)
                                        <option value="{{ $compagny->id }}" {{ old('company_id', $service
                                        ->company_id) == $compagny->id ? 'selected' : '' }}>
                                            {{ $compagny->name }} ({{ $compagny->country }})   

                                        </option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Actif -->
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Actif</label>
                                <select id="is_active" name="is_active" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1" {{ old('is_active', $service->is_active) == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="0" {{ old('is_active', $service->is_active) == 0 ? 'selected' : '' }}>Non</option>
                                </select>
                                @error('is_active')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Enregistrer
                            </button>
                            <a href="{{ route('services.index') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection