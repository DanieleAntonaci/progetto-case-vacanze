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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name',64);
            $table->integer('id_spot') -> uniqid() -> unsigned();
            $table->tinyInteger('number_people') -> unisegned();
            $table->tinyInteger('num_min_people') -> unisegned();
            $table->tinyInteger('num_max_people') -> unisegned();
            $table->tinyInteger('double_beds') -> unsigned();
            $table->boolean('single_bed') -> default(false);
            $table->boolean('sofa_bed') -> default(false);
            $table->tinyInteger('number_bathrooms') -> unsigned();
            $table->smallInteger('square_meters')-> unsigned();
            $table->boolean('visible')-> default(true);
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
