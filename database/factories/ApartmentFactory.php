<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => fake() -> name(),
            'id_spot' => fake() -> numberBetween(10000, 99999),
            'number_people' => fake() -> numberBetween(2, 6),
            'num_min_people' => fake() -> numberBetween(2,4),
            'num_max_people' => fake() -> numberBetween(4,6),
            'double_beds' => fake() -> numberBetween(1,3),
            'number_bathrooms' => fake() -> numberBetween(1,3),
            'square_meters' => fake() -> numberBetween(30,130),
            'description' => fake() -> paragraph(3),
            
        ];
    }
}
