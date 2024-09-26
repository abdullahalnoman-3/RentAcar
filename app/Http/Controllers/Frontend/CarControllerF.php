<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class CarControllerF extends Controller
{
    public function check_availability(Request $request)
    {
        // Validate the request data
        $request->validate([
            'brand' => 'required|string',
            'price_range' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Parse price range
        list($minPrice, $maxPrice) = explode('-', $request->price_range);

        // Find available cars based on start_date and end_date
        $availableCars = Car::where('brand', $request->brand)
            ->whereBetween('daily_rent_price', [(int)$minPrice, (int)$maxPrice]) // Price range filtering
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

        // Return available cars
        return view('book_a_car', compact('availableCars', 'startDate', 'endDate'));
    }


    public function car_details(Request $request)
    {
        $car_id = $request->car_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Get car details by car_id
        $car = Car::findOrFail($car_id);


            // Check if the car is available for the provided start and end date
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

        // Pass the car details and availability status to the view
        return view('car_details', compact('car', 'isAvailable', 'startDate', 'endDate'));
    }


    public function confirm_booking(Request $request)
    {
        

        // Create the booking in the rentals table
        $rental = Rental::create([
            'car_id' => $request->car_id,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $request->total_cost,
        ]);

        // Redirect with a success message
        return redirect()->route('dashboard')->with('success', 'Your booking has been confirmed!');
    }


}
