@extends('layouts.app')

@section('header')
Créer un envoi de colis
@endsection

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de colis</label>
                    <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Sélectionner un type</option>
                        <option value="Medicament">Medicament</option>
                        <option value="Valise">Valise</option>
                        <option value="Document">Docuement</option>
                        <option value="Autre">Autre</option>
                    </select>
                    @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="weight" class="block text-sm font-medium text-gray-700">Poids</label>
                    <div class="relative">
                        <input type="text" name="weight" id="weight"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('weight') }}">
                        <span class="absolute right-3 top-2 text-gray-400">
                            kg
                        </span>
                    </div>
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
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->type }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Expéditeur -->
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Expéditeur</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <select name="sender_id" class="flex-1 rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionner un expéditeur</option>
                            @foreach($senders as $sender)
                            <option value="{{ $sender->id }}">{{ $sender->name }}</option>
                            @endforeach
                        </select>
                        <button data-bs-toggle="modal" data-bs-target="#userModal" data-user-type="sender" type="button" class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            <svg class="h-5 w-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Champ Récepteur -->
                <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Récepteur</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <select name="recipient_id" class="flex-1 rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionner un récepteur</option>
                            @foreach($recipients as $recipient)
                            <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                            @endforeach
                        </select>
                        <button data-bs-toggle="modal" data-bs-target="#userModal" data-user-type="recipient" type="button" class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                            <svg class="h-5 w-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="departure_date" class="block text-sm font-medium text-gray-700">Date de départ</label>
                    <input type="date" name="departure_date" id="departure_date"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        value="{{ old('departure_date') }}">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="created" selected>Créé</option>
                        <option value="processed">Traité</option>
                        <option value="shipped">Expédié</option>
                        <option value="in_transit">En transit</option>
                        <option value="delivered">Livré</option>
                    </select>
                    @error('status')
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
@include('users.modals.user-add');
@endsection

@section('scripts')
<!-- <script src="{{ asset('js/modal-user.js') }}"></script> -->
<script>
    var modal = new bootstrap.Modal(document.getElementById('userModal'), {
        keyboard: false
    });
    $(document).ready(function() {
        // Gestion de l'ouverture du modal
        $('#userModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const userType = button.data('user-type');
            $('#userType').val(userType);
        });

        // Soumission du formulaire
        $('#userForm').submit(function(e) {
            e.preventDefault();
        
            $('#userForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('users.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {

                        if (response.ok) {
                           const data = response.data;
                           const userType = $('#userType').val();
                           $(`select[name="${userType}_id"]`).append(
                               `<option value="${data.id}" selected>${data.name}</option>`
                           );
                           $('#userModal').modal('hide');
                        }
                
                        $('#userForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Erreur: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    });
</script>
@endsection