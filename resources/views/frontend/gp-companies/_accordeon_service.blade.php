@if ($service->destinations->count() > 0)
<div class="accordion">
    <div class="border rounded-lg mb-2">
        <button class="accordion-btn w-full px-4 py-3 text-left bg-white hover:bg-gray-50 flex justify-between items-center">
            <span>{{ $service->type }}</span>
            <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div class="accordion-content max-h-0 overflow-hidden transition-all duration-300">
            <div class="px-4 py-2 bg-gray-50 border-t">
                @foreach ($service->destinations as $destination)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-md font-medium bg-blue-100 text-blue-800">
                    {{ $destination->country }}
                </span>
            
                <ul class="space-y-4 mb-2">
                    <li class="flex items-center text-200 text-gray-700">
                        <svg class="w-5 h-5 mr-2 text-green-500">...</svg>
                        {{ \Carbon\Carbon::parse($destination->departure_date)->isoFormat('dddd D MMMM YYYY') }}
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
<!-- @if ($service->destinations->count() === 0)
<div class="border rounded-lg mb-2">
    <button class="accordion-btn w-full px-4 py-3 text-left bg-white hover:bg-gray-50 flex justify-between items-center">
        <p text-sm text-gray-500>Aucun service disponible</p>
    </button>
</div>
@endif -->