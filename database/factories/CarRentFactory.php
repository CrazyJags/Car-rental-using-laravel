<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarRent>
 */
class CarRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTime();
        return [
            'start_date' => $startDate,
            'end_date'   => Carbon::parse($startDate)->addDays(random_int(1, 10)),
            'car_id'     => $this->faker->randomElement(Car::pluck('id')->toArray()),
            'user_id'    => $this->faker->randomElement(User::pluck('id')->toArray())
        ];
    }
}
