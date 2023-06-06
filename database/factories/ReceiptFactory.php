<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake() -> numberBetween(10000,99999) ,
            'type' => fake() -> randomElement(['ricevuta fiscale', 'fattura']),
            'description' => fake() -> text(),
            'tax' => fake() -> numberBetween(5,21),
            'people' => fake() -> numberBetween(1,6),
            'date' => fake() -> date()
        ];
    }
}
