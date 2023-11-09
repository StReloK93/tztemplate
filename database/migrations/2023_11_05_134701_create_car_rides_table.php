<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_rides', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('start_city');
            $table->integer('end_city');
            $table->dateTime('ride_time');
            $table->boolean('strictly_on_time');
            $table->integer('price');
            $table->boolean('address_to_address');
            $table->integer('free_seat');
            $table->boolean('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rides');
    }
};
