<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réserver : ') }} {{ $property->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Affichage de la propriété -->
                <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                <p class="text-gray-600">{{ $property->description }}</p>
                <p class="text-green-600 font-semibold mt-2">Prix / nuit : €{{ $property->price_per_night }}</p>

                <!-- Intégration du formulaire Livewire pour la réservation -->
                @livewire('booking-manager', ['propertyId' => $property->id])
                
            </div>
        </div>
    </div>
</x-app-layout>