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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->integer('car_ride_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->integer('start_city');
            $table->integer('end_city');
            $table->boolean('with_trunk')->nullable();
            $table->dateTime('ride_time')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
