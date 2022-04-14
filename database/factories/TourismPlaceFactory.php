<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourismPlace>
 */
class TourismPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'location' => $this->faker->city(),
            'mainImage' => '0.0.0.0/storage/images/red-hat.png',
            'open' => $this->faker->word(),
            'hours' => '12.00 - 14.00',
            'ticket' => 10000,
            'description' => $this->faker->paragraph(),
        ];
    }
}
