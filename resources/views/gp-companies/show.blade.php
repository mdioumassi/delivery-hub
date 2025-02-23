@extends('layouts.app')

@section('content')
<!-- <div class="bg-gray-50 min-h-screen p-8">
  <div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Samabagage</h1>
        <div class="flex space-x-2">
          <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Envoyer
          </button>
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

    <div class="space-y-6">
    
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Envoi aérien</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">AF 718</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23 Fév 2025 - 10:30</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Paris (CDG)</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Disponible
                  </span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SN 205</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23 Fév 2025 - 15:45</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dakar (DKR)</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Presque complet
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Envoi maritime</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Navire</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Port</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">MSC EMMA</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25 Fév 2025</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Le Havre</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Disponible
                  </span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">CMA CGM MARCO POLO</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28 Fév 2025</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Marseille</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Disponible
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> -->
<div class="accordion">
  <div class="border rounded-lg mb-2">
    <button class="accordion-btn w-full px-4 py-3 text-left bg-white hover:bg-gray-50 flex justify-between items-center">
      <span>Section 1</span>
      <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>
    <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
      <div class="px-4 py-2 bg-gray-50 border-t">
        <p>Contenu de la section...</p>
      </div>
    </div>
  </div>
</div>
</script>
@endsection
@section('scripts')
<script>
  document.querySelectorAll('.accordion-btn').forEach(button => {
    button.addEventListener('click', () => {
      const content = button.nextElementSibling;
      const isOpen = content.style.maxHeight;

      // Fermer tous les autres
      document.querySelectorAll('.accordion-content').forEach(item => {
        item.style.maxHeight = null;
      });

      // Toggle l'état actuel
      if (!isOpen || isOpen === '0px') {
        content.style.maxHeight = content.scrollHeight + 'px';
      } else {
        content.style.maxHeight = null;
      }
    });
  });
</script>
@endsection