<x-app-layout>
    <!-- Header Slot -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
   

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Cards Row 1 -->
                    <div class="row my-4">
                        <!-- Card 1: Total Cars -->
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Cars</h5>
                                    {{-- Cars টেবিল থেকে মোট গাড়ির সংখ্যা প্রদর্শন করা হচ্ছে --}}
                                    <p class="card-text display-4">{{ $totalCars }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Total Available Cars -->
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Available Cars</h5>
                                    {{-- Available Cars টেবিল থেকে মোট 'available' গাড়ির সংখ্যা প্রদর্শন করা হচ্ছে --}}
                                    <p class="card-text display-4">{{ $availableCars }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Total Rentals -->
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Rentals</h5>
                                    {{-- Rentals টেবিল থেকে মোট রেন্টালের সংখ্যা প্রদর্শন করা হচ্ছে --}}
                                    <p class="card-text display-4">{{ $totalRentals }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cards Row 2 -->
                    <div class="row my-4">
                        <!-- Card 4: Total Earnings From Rentals -->
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Earnings From Rentals</h5>
                                    {{-- Rentals টেবিল থেকে মোট আয় প্রদর্শন করা হচ্ছে --}}
                                    <p class="card-text display-4">${{ $totalEarnings }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5: Total Users -->
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    {{-- Users টেবিল থেকে মোট ইউজার সংখ্যা প্রদর্শন করা হচ্ছে --}}
                                    <p class="card-text display-4">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6: Support Tickets -->
                        <div class="col-md-4">
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Support Tickets</h5>
                                    <p class="card-text display-4">Just Desgin</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </x-slot>
</x-app-layout>
