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
      <div class="mt-2 text-sm">Choisir une date</div>
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

    <div class="space-y-6">
      @foreach($company->services as $service)
      @IF ($service->destinations->count() > 0)
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $service->type }}</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom vol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Choisir</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
           
                  @foreach ($service->destinations as $destination)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $destination->flight_name }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($destination->departure_date)->isoFormat('dddd D MMMM YYYY') }} - {{ $destination->departure_time }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $destination->country }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                         <form action="">
                          <input type="radio" name="destination" value="{{ $destination->id }}">
                          <!-- <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Choisir
                          </button> -->
                         </form>
                        </span>
                      </td>
                    </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
      @endforeach
      <div class="bouton-container" style="margin-top: 20px; text-align: right;">
      <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
        Suivant
      </button>
    </div>
    </div>
  </div>
</div>
@endsection