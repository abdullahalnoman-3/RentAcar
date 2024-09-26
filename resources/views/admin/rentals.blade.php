<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rentals List') }}
        </h2>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-200 px-4 py-2">User</th>
                                <th class="border border-gray-200 px-4 py-2">Car Img</th>
                                <th class="border border-gray-200 px-4 py-2">Car Name</th>
                                <th class="border border-gray-200 px-4 py-2">Car Brand</th>
                                <th class="border border-gray-200 px-4 py-2">Start Date</th>
                                <th class="border border-gray-200 px-4 py-2">End Date</th>
                                <th class="border border-gray-200 px-4 py-2">Total Cost</th>
                                <th class="border border-gray-200 px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentals as $rental)
                                <tr>
                                    {{-- এখানে user সম্পর্ক থেকে ইউজারের নাম দেখাচ্ছে --}}
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->user->name }}</td>
                                    
                                    {{-- car সম্পর্ক থেকে গাড়ির মডেল দেখাচ্ছে --}}
                                    <td class="border border-gray-200 px-4 py-2">
                                        <img src="{{ asset('images/' . $rental->car->image) }}" alt="{{ $rental->car->name }}" width="100">
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->car->name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->car->brand }}</td>
                                    
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->start_date }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->end_date }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->total_cost }}</td>
                                    
                                    {{-- Status কলাম দেখানো --}}
                                    <td class="border border-gray-200 px-4 py-2">{{ $rental->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </x-slot>
</x-app-layout>
