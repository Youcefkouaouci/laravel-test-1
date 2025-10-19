<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Toutes les propriétés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-6">
                @foreach($properties as $property)
                    <div class="border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6">
                        <h3 class="text-2xl font-semibold text-gray-900">{{ $property->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $property->description }}</p>
                        
                        <p class="text-green-600 font-semibold mt-4">Prix / nuit : €{{ number_format($property->price_per_night, 2) }}</p>

                        @auth
                            @if(auth()->user()->role === 'user')
                                <a href="{{ route('booking.create', $property->id) }}" 
                                   class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                                    Réserver
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
