<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Receipt;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this -> call([
            StructureSeeder::class,
            ApartmentSeeder::class,
            ImageSeeder::class,
            ReceiptSeeder::class,
            PaymentSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
