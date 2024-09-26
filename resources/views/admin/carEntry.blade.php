<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer List') }}
        </h2>
    


    
    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car entry') }}
        </h2>

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Car Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter car name" required>
    </div>

    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter car brand" required>
    </div>

    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" class="form-control" id="model" name="model" placeholder="Enter car model" required>
    </div>

    <div class="form-group">
        <label for="year">Year of Manufacture</label>
        <input type="number" class="form-control" id="year" name="year" placeholder="Enter year of manufacture" required>
    </div>

    <div class="form-group">
        <label for="car_type">Car Type</label>
        <select class="form-control" id="car_type" name="car_type" required>
            <option value="SUV">SUV</option>
            <option value="Sedan">Sedan</option>
            <option value="Hatchback">Hatchback</option>
            <option value="Coupe">Coupe</option>
        </select>
    </div>

    <div class="form-group">
        <label for="daily_rent_price">Daily Rent Price (in $)</label>
        <input type="number" class="form-control" id="daily_rent_price" name="daily_rent_price" placeholder="Enter daily rent price" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="availability">Availability</label>
        <select class="form-control" id="availability" name="availability" required>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Car Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


    </div>



    
   <footer>
    ok
   </footer>

  












    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("i am customer") }}
                </div>
            </div>
        </div>
    </div>
    </x-slot>
</x-app-layout>
