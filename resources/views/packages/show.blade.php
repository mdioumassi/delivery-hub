@extends('layouts.app')
@section('header')
Détails du colis
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Détails du colis</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('packages.edit', $package) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition">
                            Modifier
                        </a>
                        <form method="POST" action="{{ route('packages.destroy', $package) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce colis?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                        <!-- Type de colis -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Type de colis</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @switch($package->type)
                                @case('Valise')
                                Valise
                                @break
                                @case('Medicament')
                                Medicament
                                @break
                                @case('ALiment')
                                ALiment
                                @break
                                @default
                                {{ $package->type }}
                                @endswitch
                            </dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Numéro du colis</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $package->tracking_number }}</dd>
                        </div>


                        <!-- Poids -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Poids</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $package->weight }} kg</dd>
                        </div>

                        <!-- Prix unitaire -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Prix unitaire</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ number_format($package->unit_price, 2, ',', ' ') }} €</dd>
                        </div>

                        <!-- Prix total -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Prix total</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{  number_format($package->total_price, 2, ',', ' ') }} €</dd>
                        </div>

                        <!-- Service -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Service</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @switch($package->service->type)
                                @case('Envoi aérien')
                                Envoi aérien
                                @break
                                @case('Envoi maritime')
                                Envoi maritime
                                @break
                                @case('Envoi terrestre')
                                Envoi terrestre
                                @break
                                @default
                                {{ $package->service }}
                                @endswitch
                            </dd>
                        </div>

                        <!-- Expéditeur -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Expéditeur</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $package->sender->name }}</span>
                                    <span>{{ $package->sender->email }}</span>
                                    <span>{{ $package->sender->phone }}</span>
                                    <span class="text-gray-500 text-xs mt-1">{{ $package->sender->address }}</span>
                                </div>
                            </dd>
                        </div>

                        <!-- Récepteur -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Récepteur</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $package->recipient->name }}</span>
                                    <span>{{ $package->recipient->email }}</span>
                                    <span>{{ $package->recipient->phone }}</span>
                                    <span class="text-gray-500 text-xs mt-1">{{ $package->recipient->address }}</span>
                                </div>
                            </dd>
                        </div>

                        <!-- Date de départ -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date de départ</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $package->departure_date ? date('d/m/Y', strtotime($package->departure_date)) : 'Non définie' }}
                            </dd>
                        </div>

                        <!-- Date de création -->
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date de création</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ date('d/m/Y H:i', strtotime($package->created_at)) }}
                            </dd>
                        </div>
                    </dl>

                    <!-- Statut de suivi -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900">Statut de suivi</h3>
                        <div class="mt-4">
                            <div class="relative">
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                                    @switch($package->status ?? 'created')
                                    @case('created')
                                    <div style="width:20%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    @break
                                    @case('processed')
                                    <div style="width:40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    @break
                                    @case('shipped')
                                    <div style="width:60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    @break
                                    @case('in_transit')
                                    <div style="width:80%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                    @break
                                    @case('delivered')
                                    <div style="width:100%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                                    @break
                                    @default
                                    <div style="width:10%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gray-500"></div>
                                    @endswitch
                                </div>
                                <div class="flex justify-between text-xs px-2">
                                    <span class="{{ ($package->status ?? 'created') == 'created' ? 'font-bold text-blue-600' : '' }}">Créé</span>
                                    <span class="{{ ($package->status ?? '') == 'processed' ? 'font-bold text-blue-600' : '' }}">Traité</span>
                                    <span class="{{ ($package->status ?? '') == 'shipped' ? 'font-bold text-blue-600' : '' }}">Expédié</span>
                                    <span class="{{ ($package->status ?? '') == 'in_transit' ? 'font-bold text-blue-600' : '' }}">En transit</span>
                                    <span class="{{ ($package->status ?? '') == 'delivered' ? 'font-bold text-green-600' : '' }}">Livré</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('packages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition">
                        Retour à la liste
                    </a>

                    <div class="flex space-x-2">
                      
                        <a href="#" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition">
                            Imprimer l'étiquette
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection