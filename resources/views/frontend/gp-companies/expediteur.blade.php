@extends('frontend.layout')

@section('content')
<div class="max-w-4xl mx-auto p-8">
    <!-- Steps Container -->
    <div class="flex justify-between items-center">
        <!-- Step 1 -->
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                1
            </div>
            <div class="mt-2 text-sm">Choisir une destinatuion</div>
        </div>

        <!-- Connector -->
        <div class="flex-auto border-t-2 border-gray-300"></div>

        <!-- Step 2 -->
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white">
                2
            </div>
            <div class="mt-2 text-sm">Step 2</div>
        </div>

        <!-- Connector -->
        <div class="flex-auto border-t-2 border-gray-300"></div>

        <!-- Step 3 -->
        <div class="flex flex-col items-center">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white">
                3
            </div>
            <div class="mt-2 text-sm">Step 3</div>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $company->name }} - {{ $company->country }}</h1>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-50 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Suivre les envois
                        </button>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>
@endsection