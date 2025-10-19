<div class="max-w-md mx-auto p-4">
    <form wire:submit.prevent="submitBooking">

        <div class="mt-4">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
            <input type="date" id="start_date" wire:model="start_date" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            @error('start_date')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label for="end_date" class="block text-sm font-medium text-gray-700">Date de départ</label>
            <input type="date" id="end_date" wire:model="end_date" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            @error('end_date')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                Réserver
            </button>
        </div>
    </form>
    <div class="max-w-md mx-auto p-4">
        @if (session()->has('error'))
        <div class="mt-4 text-red-500">
            {{ session('error') }}
        </div>
        @endif

        @if (session()->has('message'))
        <div class="mt-4 text-green-500">
            {{ session('message') }}
        </div>
        @endif

    </div>