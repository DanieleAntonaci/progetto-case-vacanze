<?php

namespace Database\Seeders;

use App\Models\Apartment ;
use App\Models\Service;
use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apartment::factory() -> count(14) -> make() -> each(function($apartment){
            // structure-apartment
            $structure = Structure::inRandomOrder()-> first();
            $apartment -> structure() -> associate($structure);
            $apartment -> save();

            // apartment-service
            $service = Service::inRandomOrder() -> limit(rand(5, 15)) -> get();
            $apartment -> services()-> attach($service);
        });
    }
}
