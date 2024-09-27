<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalControllerF extends Controller
{
    public function showUserBookings($id)
    {
        
        if (Auth::id() != $id) {
            abort(403); // Unauthorized access
        }

        $user = Auth::user();
        $bookings = Rental::where('user_id', $id)->with('car')->get();

        return view('user.bookings', compact('user', 'bookings'));
    }

    
    
    public function dashboard()
    {
        $user = Auth::user();

        
        $bookings = Rental::where('user_id', $user->id)->with('car')->get();

        
        return view('customer.dashboard', compact('user', 'bookings'));
    }




    public function cancelBooking($id)
{
    $booking = Rental::find($id);

    
    if ($booking && $booking->user_id == Auth::id() && $booking->status != 'Canceled') {
        
        if (now()->lessThan($booking->start_date)) {
            
            $booking->status = 'Canceled';
            $booking->save();

            return redirect()->back()->with('success', 'Booking has been canceled.');
        } else {
            return redirect()->back()->with('error', 'Booking cannot be canceled as the start time has already passed.');
        }
    }

    return redirect()->back()->with('error', 'Unable to cancel booking.');
}

}
