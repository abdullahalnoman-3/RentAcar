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
        // মোট গাড়ির সংখ্যা
        $totalCars = Car::count();

        // মোট উপলব্ধ গাড়ির সংখ্যা (availability=true)
        $availableCars = Car::where('availability', true)->count();

        // মোট রেন্টালের সংখ্যা
        $totalRentals = Rental::count();

        // মোট আয় (মোট রেন্টাল খরচের যোগফল)
        $totalEarnings = Rental::sum('total_cost');

        // মোট ইউজার সংখ্যা
        $totalUsers = User::count();

        // অন্যান্য ডেটা (যদি প্রয়োজন হয়)
        // $supportTickets = SupportTicket::count();

        // ভিউতে সমস্ত ডেটা পাঠানো
        return view('admin.dashboard', compact('totalCars', 'availableCars', 'totalRentals', 'totalEarnings', 'totalUsers'));
    }
}
