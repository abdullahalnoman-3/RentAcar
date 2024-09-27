<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        /* Custom styles for car rental system */
        .hero {
            position: relative;
            background: url('https://images.unsplash.com/photo-1484136063621-1acbc3b4ec98?q=80&w=2553&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center/cover;
            color: white;
            padding: 50px 0; /* Reduced padding to make the hero section smaller */
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
            font-size: 2.5rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            max-width: 100%;
            margin: 0 auto;
        }

        .form-container .form-group label {
            font-weight: bold;
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
            <p>Fill up the form to check available cars!</p>
            
            <!-- Form Section -->
            <div class="form-container">
                <form action="{{route('check_availability')}}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Brand Selection -->
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="brand" class="text-black">Select Car Brand</label>
                                <select class="form-select" id="brand" name="brand" required>
                                    <option value="" selected disabled>Select a Brand</option>
                                    <option value="toyota">Toyota</option>
                                    <option value="honda">Honda</option>
                                    <option value="bmw">BMW</option>
                                    <option value="ford">Ford</option>
                                    <option value="ford">Tata</option>
                                    <!-- Add more options as necessary -->
                                </select>
                            </div>
                        </div>

                        <!-- Price Range Selection -->
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="price_range" class="text-black">Select Price Range</label>
                                <select class="form-select" id="price_range" name="price_range" required>
                                    <option value="" selected disabled>Select a Price Range</option>
                                    <option value="1-50">$1 - $50/day</option>
                                    <option value="51-100">$51 - $100/day</option>
                                    <option value="101-150">$101 - $150/day</option>
                                    <option value="151-200">$151 - /day</option>
                                </select>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="start_date" class="text-black">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="end_date" class="text-black">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Find Available Cars</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="container text-center">
        <h2>Available Cars</h2>
        <div class="row">
            @if (isset($availableCars))
                @forelse ($availableCars as $car)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('images/' . $car->image) }}" class="card-img-top" alt="{{ $car->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $car->name }}</h5>
                                <p class="card-text">Brand - {{ $car->brand }}</p>
                                <p class="card-text">Model - {{ $car->model }}</p>
                                <p class="card-text">Price: ${{ $car->daily_rent_price }}/day</p>
                                <a href="{{route('car_details', [$car->id, $startDate, $endDate])}}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No cars available for the selected date range.</p>
                @endforelse
            @else
                <p>Select a date range to see available cars.</p>
            @endif
            
        </div>
    </div>


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
