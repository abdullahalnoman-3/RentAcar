<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardControllerAdm extends Controller
{
    public function index()
    {
        
        $totalCars = Car::count();

        
        $availableCars = Car::where('availability', true)->count();

        
        $totalRentals = Rental::count();

        
        $totalEarnings = Rental::sum('total_cost');

      
        $totalUsers = User::count();

      

        
        return view('admin.dashboard', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings', 'totalUsers'));
    }
}
