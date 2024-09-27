<!-- resources/views/customer/dashboard.blade.php -->

<x-user-app-layout>
    <!-- Header Slot -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<!-- Main Content -->
<div class="d-flex justify-content-center py-12">
    <!-- User Profile Card -->
    <div class="card text-center shadow-sm" style="width: 24rem;">
        <!-- User Avatar -->
        <div class="d-flex justify-content-center mt-4">
            <img src="https://images.unsplash.com/photo-1484136063621-1acbc3b4ec98?q=80&w=2553&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-circle" alt="User Avatar" style="width: 150px; height: 150px;">
        </div>
        <!-- User Details -->
        <div class="card-body">
            <h5 class="card-title">{{ Auth::user()->name }}</h5>
            <p class="card-text">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>

<!-- Bookings Table Outside Card -->
<div class="container mt-4">
    <h5>Current and Past Bookings</h5>
    <br>
    
    <table class="table table-striped table-bordered">
    <thead class="">
        <tr>
            <th class="text-center text-primary bg-dark" style="width: 20%;">Car Name</th>
            <th class="text-center text-primary bg-dark" style="width: 20%;">Car Model</th>
            <th class="text-center text-primary bg-dark" style="width: 20%;">Start Date</th>
            <th class="text-center text-primary bg-dark" style="width: 20%;">End Date</th>
            <th class="text-center text-primary bg-dark" style="width: 20%;">Status</th>
            <th class="text-center text-primary bg-dark" style="width: 20%;">Action</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td class="text-center" style="width: 20%;">{{ $booking->car->name }}</td>
                    <td class="text-center" style="width: 20%;">{{ $booking->car->model }}</td>
                    <td class="text-center" style="width: 20%;">{{ $booking->start_date }}</td>
                    <td class="text-center" style="width: 20%;">{{ $booking->end_date }}</td>
                    <td class="text-center" style="width: 20%;">{{ $booking->status }}</td>
                    <td class="text-center" style="width: 20%;">
                        <!-- Cancel Button -->
                        @if ($booking->status != 'Canceled')
                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">Cancel Booking</button>
                            </form>
                        @else
                            <span class="text-muted">Canceled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



    </x-slot>
</x-user-app-layout>
