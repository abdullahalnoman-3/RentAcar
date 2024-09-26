<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function customers()
    {
        // কেবলমাত্র 'customer' role এর ইউজারদের ডাটা আনা হবে
        $customers = User::where('role', 'customer')->get();

        // গ্রাহকদের তথ্য ভিউতে পাঠানো হচ্ছে
        return view('admin.customers', compact('customers'));
    }
    


   
}
