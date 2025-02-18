@extends('layouts.app')

@section('header')
    Services
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-end mb-4">
                <a href="{{ route('services.create') }}" class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Ajouter un service
                </a>
            </div>

            <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entreprise</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($services as $service)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $service->type }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $service->company->name }}</td>
                <td class="px-6 py-4">{{ Str::limit($service->description, 80) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $service->is_active == true ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $service->is_active == true ? 'Oui' : 'Non' }}
                  
                    </span>
                </td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('services.edit', $service) }}" 
                       class="text-blue-500 hover:text-blue-700">Éditer</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
