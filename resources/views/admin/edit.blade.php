<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
  </head>
  <body>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Car List') }}
            </h2>
            <a href="{{ route('admin.car.create') }}" class="btn btn-primary">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Car
                </button>
            </a>
        </div>
   

    

   


        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Car</h1>
        
        <form action="{{ route('admin.car.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block">Car Name</label>
                <input type="text" name="name" id="name" value="{{ $car->name }}" class="form-input mt-1 block w-full" />
            </div>
            <div class="mb-4">
                <label for="brand" class="block">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ $car->brand }}" class="form-input mt-1 block w-full" />
            </div>
            <!-- অন্যান্য ইনপুট ফিল্ড -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
       
    </x-slot>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
</body>

</html>