<?php

use App\Http\Controllers\ManageCars;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\ProfileController;
use App\Models\Rental;
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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/cars/list', function () {
//     $cars = CarController::(); 
//     return view('cars.list', compact('cars'));
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/cars/list', [CarController::class, 'cars'])->name('cars');
    Route::put('/car/{id}', [CarController::class, 'update'])->name('car.update');
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/car/{id}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::get('/car-entry', [CarController::class, 'create'])->name('car.create');
    Route::post('/cars/store', [CarController::class, 'store'])->name('cars.store');
    Route::delete('/car/{id}', [CarController::class, 'destroy'])->name('car.destroy');

    Route::get('/rentals', [RentalController::class, 'rentals'])->name('rentals');
    Route::get('/customers', [CustomerController::class, 'customers'])->name('customers');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
