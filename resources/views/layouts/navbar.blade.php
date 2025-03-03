<nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-xl font-bold">
                                Service GP
                            </a>
                        </div>
                        <a href="{{ route('persons.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('persons.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Utilisateurs
                        </a>
                        <a href="{{ route('companies.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('companies.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Entreprises
                        </a>
                        <a href="{{ route('services.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('services.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Services
                        </a>
                        <a href="{{ route('packages.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('packages.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Colis
                        </a>    
                        <a href="{{ route('containers.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('containers.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Conteneurs
                        </a>
                        <a href="{{ route('destinations.index') }}"
                            class="px-4 py-4 @if(request()->routeIs('destinations.index')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Destinations
                        </a>

                        <a href="{{ route('trackings.index', 'package') }}"
                            class="px-4 py-4 @if(request()->routeIs('trackings.index', 'package')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Suivi colis
                        </a>
                        <a href="{{ route('trackings.index', 'container') }}"
                            class="px-4 py-4 @if(request()->routeIs('trackings.index', 'container')) border-b-2 border-blue-500 text-blue-600 @else text-gray-600 @endif">
                            Suivi conteneurs
                        </a>

                    </div>
                </div>
            </div>
        </nav>