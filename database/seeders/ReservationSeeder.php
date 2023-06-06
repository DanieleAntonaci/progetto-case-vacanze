<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory() -> count(14) -> make() -> each(function($reservation){

            $apartment = Apartment::inRandomOrder()-> first();
            $reservation -> apartment() -> associate($apartment);
            $reservation -> save();
        });
    }
}
