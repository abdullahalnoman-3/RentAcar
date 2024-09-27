<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    
    public function allcars()
    {
        return view('admin.cars'); 
        
    }
    
   
    public function create()
    {
        return view('admin.carEntry');  
    }


    
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

       
        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'car_type' => $request->car_type,
            'daily_rent_price' => $request->daily_rent_price,
            'availability' => $request->availability,
            'image' => $imageName,
        ]);

       
        return redirect()->route('admin.cars.index')->with('success', 'গাড়ি সফলভাবে যোগ করা হয়েছে!');
    }

   

    public function cars()
{
    $cars = Car::all();
    return view('admin.cars', compact('cars'));
}

public function index()
{
    
    $cars = Car::all(); 
    return view('admin.cars', compact('cars')); 
}

public function edit($id)
{
    $car = Car::find($id); 
    return view('admin.edit', compact('car'));
}

public function update(Request $request, $id)
{
    $car = Car::find($id); 
    $car->update($request->all()); 

    return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
}

public function destroy($id)
{
    $car = Car::find($id); 
    $car->delete(); 

    return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');


}



}
