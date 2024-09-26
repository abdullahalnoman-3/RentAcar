<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Car List') }}
            </h2>
            <a href="{{ route('admin.car.create') }}" class="btn btn-primary">
                <button class="">
                    Add New Car
                </button>
            </a>
        </div>
   

    

    <div class="container mx-auto px-4 py-8">
        


        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif


        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">Name</th>
                    <th class="border border-gray-200 px-4 py-2">Brand</th>
                    <th class="border border-gray-200 px-4 py-2">Model</th>
                    <th class="border border-gray-200 px-4 py-2">Year</th>
                    <th class="border border-gray-200 px-4 py-2">Car Type</th>
                    <th class="border border-gray-200 px-4 py-2">Daily Rent Price</th>
                    <th class="border border-gray-200 px-4 py-2">Availability</th>
                    <th class="border border-gray-200 px-4 py-2">Image</th>
                    <th class="border border-gray-200 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($cars as $car)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->brand }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->model }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->year }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->car_type }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $car->daily_rent_price }}</td>
                        <td class="border border-gray-200 px-4 py-2">
                            {{ $car->availability ? 'Available' : 'Not Available' }}
                        </td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if ($car->image)
                                <img src="{{ asset('images/' . $car->image) }}" alt="{{ $car->name }}" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="border border-gray-200 px-4 py-2">
                           <button> <a class="btn btn-warning" href="{{ route('admin.car.edit', $car->id) }}">Edit</a></button> 
                           <form action="{{ route('admin.car.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </x-slot>
</x-app-layout>

