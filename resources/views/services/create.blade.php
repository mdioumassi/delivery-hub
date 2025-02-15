@extends('layouts.app')

@section('title', 'Créer un service')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Nouveau service</h1>
    
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 mb-2">Nom du service</label>
                <input type="text" name="name" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition-colors">
                Créer le service
            </button>
        </div>
    </form>
</div>
@endsection