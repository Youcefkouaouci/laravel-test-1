<?php

namespace App\Livewire;

use App\Models\Property;
use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $propertyId;
    public $userId;
    public $start_date;
    public $end_date;

    // Valider les champs de réservation
    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'propertyId' => 'required|exists:properties,id',
    ];

    // Lancer la logique à l'initialisation du composant
    public function mount($propertyId)
    {
        $this->propertyId = $propertyId;
        $this->userId = Auth::id(); // Utiliser Auth pour récupérer l'ID de l'utilisateur
    }

    // Méthode pour soumettre la réservation
    public function submitBooking()
    {
        $this->validate(); // Validation des champs

        // Vérification de la disponibilité de la propriété
        $existingBooking = Booking::where('property_id', $this->propertyId)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                      ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                      ->orWhere(function ($query) {
                          $query->where('start_date', '<=', $this->start_date)
                                ->where('end_date', '>=', $this->end_date);
                      });
            })
            ->exists();

        if ($existingBooking) {
            session()->flash('error', 'Cette propriété n\'est pas disponible pour les dates sélectionnées.');
            return;
        }

        // Création de la réservation
        Booking::create([
            'property_id' => $this->propertyId,
            'user_id' => $this->userId,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        return redirect()->route('bookings'); // Rediriger vers la page des réservations
    }

    // Méthode pour annuler une réservation
    public function cancelBooking()
    {
        $this->start_date = null;
        $this->end_date = null;

        session()->flash('message', 'Réservation annulée.');
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}
