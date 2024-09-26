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
            padding: 100px 0;
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
            margin-bottom: 20px;
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
            <h1>Welcome to Car Rental System</h1>
            <p>Find the perfect car for your journey at an affordable price!</p>
            <a href="#cars" class="btn btn-primary btn-lg">Explore Our Cars</a>
        </div>
    </section>

    <!-- Cars Section -->
    <section id="cars" class="my-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Cars</h2>
            <div class="row">
                

                @foreach ($cars as $car)
                    <div class="col-md-4">
                        <div class="car-card p-3">
                            <img src="{{ asset('images/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid" style="height: 300px;">
                            <h5>{{$car->name}}</h5>
                            <p>Price: ${{$car->daily_rent_price}}/day</p>
                            <a href="#" class="btn btn-success">Book Now</a>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="col-12 mb-3">
                        <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </div>
            </form>
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
