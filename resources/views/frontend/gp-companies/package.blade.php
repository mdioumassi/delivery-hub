@extends('frontend.layout')

@section('content')

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
            <div class="mt-2 text-sm">Renseignement colis</div>
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

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form action="{{ route('gp.step3.expediteur', $company->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Type de colis -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type de colis</label>
                        <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm" required>
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

                    <!-- Poids du colis -->
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700">Poids</label>
                        <div class="relative">
                            <input type="text" name="weight" id="weight"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('weight') }}" required>
                            <span class="absolute right-3 top-2 text-gray-400">
                                kg
                            </span>
                        </div>
                        @error('weight')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prix unitaire -->
                    <div>
                        <label for="unit_price" class="block text-sm font-medium text-gray-700">Prix unitaire</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="unit_price" id="unit_price"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="10" disabled>
                            <span class="absolute right-3 top-2 text-gray-400">
                                €
                            </span>
                        </div>
                        @error('unit_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Prix totale -->
                    <div>
                        <label for="total_price" class="block text-sm font-medium text-gray-700">Total a payer</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="total_price" id="total_price"
                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                            <span class="absolute right-3 top-2 text-gray-400">
                                €
                            </span>
                        </div>
                    </div>

                    <!-- Date d'envoi -->
                    <div>
                        <label for="date_dispatch" class="block text-sm font-medium text-gray-700 mb-1">Date d'envoi</label>
                        <input type="ext" id="date_dispatch" name="date_envoi" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('date_dispatch')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="bouton-container" style="margin-top: 20px; text-align: right;">
                        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                            Suivant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Sélection des éléments du formulaire
    const poidsInput = document.querySelector('#weight');
    const prixUnitaireInput = document.querySelector('#unit_price');
    const totalInput = document.querySelector('#total_price');
    // Appliquer les classes Tailwind CSS pour mettre en valeur le champ total
    totalInput.classList.add('bg-blue-50', 'border-4', 'border-blue-500', 'font-bold', 'text-blue-800', 'focus:ring-blue-500', 'focus:border-blue-500', 'transition-all', 'duration-300');


    // Fonction pour calculer le total
    function calculerTotal() {
        // Récupération des valeurs
        const poids = parseFloat(poidsInput.value) || 0;
        const prixUnitaire = parseFloat(prixUnitaireInput.value) || 0;

        // Calcul du total
        const total = poids * prixUnitaire;

        // Affichage du résultat formaté avec 2 décimales
        totalInput.value = total.toFixed(2);
    }

    // Ajout des écouteurs d'événements pour recalculer automatiquement
    poidsInput.addEventListener('input', calculerTotal);
    prixUnitaireInput.addEventListener('input', calculerTotal);

    // Calcul initial au chargement de la page
    calculerTotal();

    // Sélection du champ de date
    const dateInput = document.querySelector('#date_dispatch');

    // Fonction pour obtenir la date du jour au format jj/mm/aaaa
    function getFormattedDate() {
        const today = new Date();

        // Récupérer jour, mois et année
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
        const year = today.getFullYear();

        // Formater la date au format jj/mm/aaaa
        return `${day}/${month}/${year}`;
    }

    // Remplir le champ date avec la date du jour
    dateInput.value = getFormattedDate();

    // Optionnel: déclencher l'événement 'change' pour activer les éventuels écouteurs
    // associés à ce champ dans d'autres parties du code
    const changeEvent = new Event('change', {
        bubbles: true
    });
    dateInput.dispatchEvent(changeEvent);
</script>
@endsection