<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->get();
    
        foreach ($bookings as $booking) {

            $startDate = Carbon::parse($booking->start_date);
            $endDate = Carbon::parse($booking->end_date);
            
            $nights = $startDate->diffInDays($endDate);
    
            $totalPrice = $nights * $booking->property->price_per_night;
    
            $booking->nights = $nights;
            $booking->totalPrice = $totalPrice;
        }
    
        return view('bookings.index', compact('bookings'));
    }


   public function create($propertyId)
   {
       // Récupérer la propriété par ID
       $property = Property::findOrFail($propertyId);
       
       // Retourner la vue avec la propriété
       return view('bookings.create', compact('property'));
   }

   public function destroy(Booking $booking)
   {
       $booking->delete();
       return redirect()->route('bookings');
   }

    public function redirectBookings()
    {
        return redirect()->route('bookings');
    }
}
