<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmedMail;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
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

        return redirect()->back()->with('success', 'Booking completed and email sent.');
    }
}