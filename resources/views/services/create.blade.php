@extends('layouts.app')

@section('header')
Créer un service
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de service</label>
                    <select name="type" id="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    ">
                        <option value="">Sélectionner un type</option>
                        <option value="Envoi aérien">Envoi aérien</option>
                        <option value="Envoi maritime">Envoi maritime</option>
                        <option value="terrestre"> Envoi terrestre</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="company_id" class="block text-sm font-medium text-gray-700">Entreprise</label>
                    <select name="company_id" id="company_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                    ">
                        <option value="">Sélectionner une entreprise</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>  
                </div>

                <div class="mb-4">
                    <label for="active" class="block text-sm font-medium text-gray-700">Actif</label>
                    <div class="flex items-center">
                            <select name="is_active" id="is_active" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="1">Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>
                </div>
               
            </div>


            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer un service
                </button>
                <a href="{{ route('packages.index') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
  
@endsection