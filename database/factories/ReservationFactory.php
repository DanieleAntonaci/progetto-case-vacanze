<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guest' => fake() -> name(),
            'telephone_number' => fake() -> randomNumber(9, true),
            'email' => fake() -> email(),
            'arrival_date' => fake() -> date(),
            'departure_date' => fake() -> date(),
            'booking_date' => fake() -> date(),
            'price' => fake() -> numberBetween(600,2000),
            'linen' => fake() -> numberBetween(0, 2),
            'price_linen' => fake() -> numberBetween(0, 60),
            'num_reservation' => fake() -> randomNumber(5, true),
            'cot'=> fake()-> boolean(),
            'crib'=> fake()-> boolean(),

        ];
    }
}
