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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            
            $table->string('guest', 64);
            $table->string('telephone_number', 32)-> nullable();
            $table->string('email')-> nullable();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->date('booking_date') -> nullable();
            $table->integer('price');
            $table->tinyInteger('linen')-> nullable();
            $table->smallInteger('price_linen')-> nullable();
            $table->string('num_reservation', 16)-> nullable();
            $table->boolean('cot')-> default(false);
            $table->boolean('crib')-> default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
