@extends('layouts.app')

@section('header')
    Suivi des colis
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Colis
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Conteneur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Destination
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($trackings as $tracking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tracking->tracking_date->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><a
                                        href="{{ route('packages.show', $tracking->package) }}">
                                        #{{ $tracking->package->id }}
                                    </a></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tracking->container->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tracking->destination->country }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"> <span
                                        class="badge bg-{{ $tracking->status == 1 ? 'success' : 'warning' }}">
                                        {{ $tracking->status == 1 ? 'En cours' : 'Terminé' }}
                                    </span></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tracking->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Afficher les liens de pagination --}}
        <div class="d-flex justify-content-center">
            {{ $trackings->links() }}
        </div>
    </div>
    </div>
    </div>
@endsection
