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
        // নিশ্চিত করুন যে শুধুমাত্র নিজস্ব বুকিং দেখা যায়
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

        // ইউজারের বুকিং ডেটা সংগ্রহ করা
        $bookings = Rental::where('user_id', $user->id)->with('car')->get();

        // ভিউতে ডেটা পাঠানো
        return view('customer.dashboard', compact('user', 'bookings'));
    }




    public function cancelBooking($id)
{
    $booking = Rental::find($id);

    // যদি বুকিং পাওয়া যায় এবং বর্তমান ইউজারের হয় এবং স্ট্যাটাস ক্যানসেল নয়
    if ($booking && $booking->user_id == Auth::id() && $booking->status != 'Canceled') {
        // চেক করুন বুকিং শুরুর তারিখ বর্তমান তারিখের আগে কিনা
        if (now()->lessThan($booking->start_date)) {
            // বুকিং ক্যানসেল করা হবে
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
