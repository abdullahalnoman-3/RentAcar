<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function customers()
    {
        
        $customers = User::where('role', 'customer')->get();

        
        return view('admin.customers', compact('customers'));
    }
    


   
}
