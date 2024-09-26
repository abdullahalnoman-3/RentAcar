<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT for id
            $table->string('name'); // STRING for car name
            $table->string('brand'); // STRING for brand
            $table->string('model'); // STRING for model
            $table->integer('year'); // INTEGER for year of manufacture
            $table->string('car_type'); // STRING for car type (SUV, Sedan, etc.)
            $table->decimal('daily_rent_price', 8, 2); // DECIMAL for daily rent price
            $table->boolean('availability')->default(true); // BOOLEAN for availability status
            $table->string('image')->nullable(); // STRING for car image
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
        Schema::dropIfExists('cars');
    }
}
