<!-- resources/views/customer/dashboard.blade.php -->

<x-app-layout>
    <!-- Header Slot -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    

 <!-- Main Content -->
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Car Model</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->car->model }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
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
</x-app-layout>
