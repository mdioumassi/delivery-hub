@extends('layouts.app')
@section('header')
Liste des companies
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-end items-center mb-6">
                    <a href="{{ route('companies.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Nouvel entreprise
                    </a>
                </div>

                <!-- Barre de recherche -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('companies.index') }}">
                        <div class="flex gap-3">
                            <input type="text" name="search" placeholder="Rechercher par nom, SIRET, Email..."
                                value="{{ request('search') }}"
                                class="flex-1 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tableau des companies -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom de l'entreprise
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pays de l'entreprise
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Téléphone
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Portable
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gestionnaire
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Services
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($companies as $company)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-4 text-sm font-medium text-gray-900">
                                    {{ $company->name }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $company->country }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $company->email }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $company->phone_fixe }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $company->phone_mobile }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $company->gestionnaire->fullname ? $company->gestionnaire->fullname : 'Non assigné' }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    @if($company->services && $company->services->count() > 0)
                                    <ul class="space-y-1 text-sm">
                                        @foreach($company->services as $service)
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ $service->type }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <!-- <p class="text-sm text-gray-500">Aucun service disponible</p> -->
                                    @php $companyId = $company->id; @endphp
                                    @include('companies.services-table-cell')
                                    <button type="button"
                                        onclick="openServicesModal()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Ajouter un service
                                    </button>
                                    @endif
                                </td>

                                <td class="py-4 px-4 text-sm text-gray-500 flex gap-2">
                                    <a href="{{ route('companies.show', $company) }}" class="text-blue-600 hover:text-blue-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('companies.edit', $company) }}" class="text-yellow-600 hover:text-yellow-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('companies.destroy', $company) }}"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette company?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 px-4 text-center text-gray-500">
                                    Aucune company trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    let serviceIndex = 0;

    function openServicesModal() {
        document.getElementById('services-modal').classList.remove('hidden');
    }

    function closeServicesModal() {
        document.getElementById('services-modal').classList.add('hidden');
    }

    function addServiceField() {
        serviceIndex++;

        const container = document.getElementById('services-container');
        const newServiceItem = document.createElement('div');
        newServiceItem.className = 'service-item mb-4 p-4 border border-gray-200 rounded-md';
        newServiceItem.innerHTML = `
            <div class="flex justify-between items-center mb-2">
                <h4 class="text-sm font-medium text-gray-700">Service #${serviceIndex + 1}</h4>
                <button type="button" onclick="removeServiceField(this)" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 gap-4">
                  <div>
                    <label for="service_type_${serviceIndex}" class="block text-sm font-medium text-gray-700">Type de service</label>
                    <select name="services[${serviceIndex}][type]" id="service_type_${serviceIndex}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Sélectionner un type</option>
                        @foreach(\App\Enums\ServiceTypeEnum::cases() as $type)
                            <option
                                value="{{ $type->value }}"
                                {{ old('type') === $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="service_description_${serviceIndex}" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="services[${serviceIndex}][description]" id="service_description_${serviceIndex}" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="service_is_active_${serviceIndex}" class="block text-sm font-medium text-gray-700">Actif</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select name="services[${serviceIndex}][is_active]" id="service_is_active_${serviceIndex}" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>
            </div>
        `;

        container.appendChild(newServiceItem);
    }

    function removeServiceField(button) {
        const serviceItem = button.closest('.service-item');
        serviceItem.remove();
    }
</script>
@endsection