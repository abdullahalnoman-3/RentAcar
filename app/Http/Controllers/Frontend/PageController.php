<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function home(){

        $cars = Car::all();
        return view('welcome', compact('cars'));
    }

    function book_a_car(){
        return view('book_a_car');
    }
}
