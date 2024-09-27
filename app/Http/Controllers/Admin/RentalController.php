<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function rentals()
    {
        
        $rentals = Rental::with(['user', 'car'])->get();

        
        return view('admin.rentals', compact('rentals'));
    }

   
}
