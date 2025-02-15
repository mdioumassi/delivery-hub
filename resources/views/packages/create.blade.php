Laravel Blade Views

// resources/views/layouts/app.blade.php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Shipping App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center">
                        Shipping App
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('packages.index') }}" class="nav-link">Colis</a>
                        <a href="{{ route('containers.index') }}" class="nav-link">Conteneurs</a>
                        <a href="{{ route('services.index') }}" class="nav-link">Services</a>
                        <a href="{{ route('companies.index') }}" class="nav-link">Entreprises</a>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <div class="ml-3 relative">
                            <span>{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-500">Déconnexion</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

// resources/views/packages/index.blade.php
@extends('layouts.app')

@section('title', 'Liste des colis')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between">
        <h1 class="text-2xl font-bold">Liste des colis</h1>
        <a href="{{ route('packages.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Nouveau colis
        </a>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Poids
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix unitaire
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($packages as $package)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->weight }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $package->unit_price }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $package->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $package->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('packages.show', $package) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            Voir
                        </a>
                        <a href="{{ route('packages.edit', $package) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">
                            Modifier
                        </a>
                        <form action="{{ route('packages.destroy', $package) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce colis ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $packages->links() }}
        </div>
    </div>
</div>
@endsection

// resources/views/packages/create.blade.php
@extends('layouts.app')

@section('title', 'Nouveau colis')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-bold">Nouveau colis</h1>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="fragile">Fragile</option>
                        <option value="standard">Standard</option>
                        <option value="heavy">Lourd</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="weight" class="block text-sm font-medium text-gray-700">Poids</label>
                    <input type="text" name="weight" id="weight" 
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('weight') }}">
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