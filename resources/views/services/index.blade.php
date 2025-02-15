@extends('layouts.app')

@section('title', 'Liste des services')

@section('content')
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($services as $service)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $service->name }}</td>
                <td class="px-6 py-4">{{ Str::limit($service->description, 50) }}</td>
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
