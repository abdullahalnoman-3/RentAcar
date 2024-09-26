<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rentals';

    protected $fillable = [
        'car_id',     // গাড়ির সাথে সম্পর্কিত foreign key
        'user_id',    // ইউজারের সাথে সম্পর্কিত foreign key
        'rental_date',
        'return_date',
        'price',
        'status',
    ];

    // Define the belongsTo relationship with the Car model
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Define the belongsTo relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
