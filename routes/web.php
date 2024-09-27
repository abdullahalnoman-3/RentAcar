<?php

use App\Http\Controllers\ManageCars;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardControllerAdm;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CarControllerF;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalControllerF;
use App\Http\Controllers\ProfileController;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/book_a_car', [PageController::class, 'book_a_car'])->name('book_a_car');

Route::patch('/bookings/cancel/{id}', [RentalControllerF::class, 'cancelBooking'])->name('bookings.cancel');

//mail
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');



// customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [RentalControllerF::class, 'dashboard'])->name('dashboard');

    

    Route::get('/user/bookings/{id}', [RentalControllerF::class, 'showUserBookings'])->name('user.bookings');

    Route::post('/check_availability', [CarControllerF::class, 'check_availability'])->name('check_availability');
    Route::get('/car_details/{car_id}/{start_date}/{end_date}', [CarControllerF::class, 'car_details'])->name('car_details');
    Route::post('/confirm_booking', [CarControllerF::class, 'confirm_booking'])->name('confirm_booking');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //dashbord


    Route::get('/dashboard', [DashboardControllerAdm::class, 'index'])->name('dashboard');
   



    Route::get('/cars/list', [CarController::class, 'cars'])->name('cars');
    Route::put('/car/{id}', [CarController::class, 'update'])->name('car.update');
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/car/{id}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::get('/car-entry', [CarController::class, 'create'])->name('car.create');
    Route::post('/cars/store', [CarController::class, 'store'])->name('cars.store');
    Route::delete('/car/{id}', [CarController::class, 'destroy'])->name('car.destroy');

   

    //customer
    Route::get('/customers', [CustomerController::class, 'customers'])->name('customers.index');
    Route::get('/customers', [CustomerController::class, 'customers'])->name('customers');

    //rental
    Route::get('/rentals', [RentalController::class, 'rentals'])->name('rentals');
    
    
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
