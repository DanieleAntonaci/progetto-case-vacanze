<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receipt::factory() -> count(14) -> make() -> each(function($receipt){

            $apartment = Apartment::inRandomOrder()-> first();
            $receipt -> apartment() -> associate($apartment);
            $receipt -> save();
        });
    }
}
