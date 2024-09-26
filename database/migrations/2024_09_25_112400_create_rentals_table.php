<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT for id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // BIGINT for user_id (FK)
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');  // BIGINT for car_id (FK)
            $table->date('start_date'); // DATE for rental start date
            $table->date('end_date'); // DATE for rental end date
            $table->decimal('total_cost', 10, 2); // DECIMAL for total cost
            $table->timestamps(); // created_at and updated_at as TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
