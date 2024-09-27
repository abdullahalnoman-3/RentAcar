<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirmedMail;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CarControllerF extends Controller
{
    public function check_availability(Request $request)
    {
        
        $request->validate([
            'brand' => 'required|string',
            'price_range' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        
        list($minPrice, $maxPrice) = explode('-', $request->price_range);

        
        $availableCars = Car::where('brand', $request->brand)
            ->whereBetween('daily_rent_price', [(int)$minPrice, (int)$maxPrice]) 
            ->whereDoesntHave('rentals', function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                        });
                });
            })
            ->get();

       
        return view('book_a_car', compact('availableCars', 'startDate', 'endDate'));
    }


    public function car_details(Request $request)
    {
        $car_id = $request->car_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        
        $car = Car::findOrFail($car_id);


          
            $isAvailable = !$car->rentals()->where(function($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
                });
            })->exists();

        
        return view('car_details', compact('car', 'isAvailable', 'startDate', 'endDate'));
    }


    public function confirm_booking(Request $request)
    
    {
        // বুকিং 
        $booking = new Rental();
        $booking->user_id = auth()->id();
        $booking->car_id = $request->car_id;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->total_cost = $request->total_cost;
        $booking->save();

        // মেইল 
        Mail::to($booking->user->email)->send(new BookingConfirmedMail($booking));

        return redirect()->route('dashboard')->with('success', 'Booking completed and email sent.');
    }


}
