<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vos réservations
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 space-y-6">
                @foreach($bookings as $booking)
                    <div class="border border-gray-200 rounded-lg shadow-lg p-4 hover:shadow-2xl transition-shadow duration-300">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->start_date)->format('d-m-Y') }}</h3>
                            <p class="text-gray-500">{{ \Carbon\Carbon::parse($booking->end_date)->format('d-m-Y') }}</p>
                        </div>
                        
                        <div class="mt-2">
                            <p class="text-gray-800 font-semibold">Propriété : <span class="text-indigo-600">{{ $booking->property->name }}</span></p>
                        </div>

                        <div class="mt-4">
                            <p class="text-green-600 font-semibold">Prix total : <span class="font-bold text-lg">€{{ number_format($booking->totalPrice, 2) }}</span></p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
