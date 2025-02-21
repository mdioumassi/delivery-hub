@extends('layouts.app')

@section('header')
Créer une destination
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('destinations.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">

                <div class="mb-3">
                    <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select name="country" id="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($countries as $code => $country)
                        <option value="{{ $code }}" @if ($code=='fr' ) selected @endif>
                            {{ $country['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="departure_date" class="block text-sm font-medium text-gray-700">Jours de depart</label>
                    <input type="date" name="departure_date" id="departure_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-3">
                    <label for="arrival_date" class="block text-sm font-medium text-gray-700">Jours d'arrivée</label>
                    <input type="date" name="arrival_date" id="arrival_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-3">
                    <label for="company_id" class="block text-sm font-medium text-gray-700">Entreprise</label>
                    <select name="company_id" id="company_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="">Sélectionner une entreprise</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">
                            {{ $company->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('company_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Créer la destination
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection