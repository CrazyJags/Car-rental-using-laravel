<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarImage>
 */
class CarImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $url = $this->faker->imageUrl();
        return [
            'car_id'     => $this->faker->randomElement(Car::pluck('id')->toArray()),
            'image_path' => $url,
            'image_link' => $url
        ];
    }
}
