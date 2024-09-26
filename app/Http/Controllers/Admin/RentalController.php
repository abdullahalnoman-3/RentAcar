<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function rentals()
    {
        // Rentals টেবিল থেকে সমস্ত ডাটা নিয়ে আসা
        $rentals = Rental::with(['user', 'car'])->get();

        // ডাটা ভিউতে পাঠানো
        return view('admin.rentals', compact('rentals'));
    }
}
