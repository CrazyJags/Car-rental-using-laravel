<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Tests\TestCase;

class CarsTest extends TestCase
{
    public function test_cars_list_can_be_accessed_anonymously(): void
    {
        $this->get('/cars')
            ->assertOk()
            ->assertViewIs('user.pages.cars');
    }

    public function test_authenticated_user_can_access_cars_lst(): void
    {
        $this->be(User::factory()->make());
        $this->get('/cars')
            ->assertOk()
            ->assertViewIs('user.pages.cars');
    }

    public function test_existing_car_can_be_accessed_anonymously(): void
    {
        $car = Car::factory()->create();
        $this->get('/cars/'.$car->id)
            ->assertOk()
            ->assertViewIs('user.pages.car');
    }

    public function test_authenticated_user_can_access_existing_car(): void
    {
        $this->be(User::factory()->make());
        $car = Car::factory()->create();
        $this->get('/cars/'.$car->id)
            ->assertOk()
            ->assertViewIs('user.pages.car');
    }

    public function test_not_found_for_non_existing_car_and_anonymous_user(): void
    {
        $this->get('/cars/0')
            ->assertNotFound();
    }

    public function test_not_found_for_non_existing_car_and_authenticated_user(): void
    {
        $this->be(User::factory()->make());
        $this->get('/cars/0')
            ->assertNotFound();
    }
}
