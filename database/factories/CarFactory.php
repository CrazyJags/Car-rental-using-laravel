<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'brand'       => $this->faker->word(),
            'model'       => $this->faker->word(),
            'year'        => $this->faker->numberBetween(1950, 2022),
            'color'       => $this->faker->colorName(),
            'description' => $this->faker->text(),
            'hourly_rate' => $this->faker->numberBetween(50, 50000)
        ];
    }
}
