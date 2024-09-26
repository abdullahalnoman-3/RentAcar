<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System - Car Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        /* Custom styles for car rental system */
        .hero {
            position: relative;
            background: url('https://images.unsplash.com/photo-1484136063621-1acbc3b4ec98?q=80&w=2553&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center/cover;
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        /* Black overlay */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* 50% opacity black overlay */
            z-index: 1;
        }

        /* Text styling (above overlay) */
        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .car-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .car-card img {
            border-bottom: 1px solid #ddd;
        }

        .car-card h5 {
            margin: 15px 0;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Car Rental System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Home Button -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- Book a Car Button -->
                    <li class="nav-item">
                        <a class="nav-link text-white bg-primary rounded" href="{{route('book_a_car')}}">Book a Car</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        <!-- If the user is not logged in -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <!-- If the user is logged in -->
                        <li class="nav-item">
                            @if (Auth::user()->role=="admin")
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @else
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h2 class="text-center">Car Details</h2>
        </div>
    </section>
    @if ($isAvailable != 1)
        @php exit("<h2>Car not available in the selected date range</h2>"); @endphp        
    @endif
    <!-- Cars Section -->
    <section id="cars" class="my-5">
        <div class="container">
            <div class="row">
                <!-- Car Details Section -->
                <div class="col-md-6">
                    <div class="card car-card mb-4">
                        <img src="{{ asset('images/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text"><strong>Brand:</strong> {{ $car->brand }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $car->daily_rent_price }}/day</p>
                            <p class="card-text"><strong>Selected Dates:</strong> {{ $startDate }} to {{ $endDate }}</p>
                            <p class="card-text"><strong>Total Cost:</strong> ${{ $car->daily_rent_price * \Carbon\Carbon::parse($endDate)->diffInDays(\Carbon\Carbon::parse($startDate)) }} for {{ \Carbon\Carbon::parse($endDate)->diffInDays(\Carbon\Carbon::parse($startDate)) }} days</p>
                        </div>
                    </div>
                </div>

                @php
                    $total_cost = $car->daily_rent_price * \Carbon\Carbon::parse($endDate)->diffInDays(\Carbon\Carbon::parse($startDate));    
                @endphp
                <!-- Booking Form Section -->
                <div class="col-md-6">
                    <div class="card p-4">
                        <h5>Book this car</h5>
                        <form action="{{route('confirm_booking')}}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="start_date" value="{{ $startDate }}">
                            <input type="hidden" name="end_date" value="{{ $endDate }}">
                            <input type="hidden" name="total_cost" value="{{ $total_cost }}">

                            <!-- User Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            <!-- Start Date -->
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="text" class="form-control" value="{{ $startDate }}" readonly>
                            </div>

                            <!-- End Date -->
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="text" class="form-control" value="{{ $endDate }}" readonly>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-lg">Confirm Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p>&copy; 2024 Car Rental System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
