<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\CarRent;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\SetUpAdmin;

class CarRentManagementTest extends TestCase
{
    use SetUpAdmin;

    public function test_get_all(): void
    {
        User::factory(5)->create();
        Car::factory(5)->create();
        CarRent::factory(10)->create();
        $this->be($this->getAdmin());
        $this->get('/admin/rents')
            ->assertViewIs('admin.pages.rent');
    }

    public function test_delete_existing_rent(): void
    {
        User::factory()->create();
        Car::factory()->create();
        $rent = CarRent::factory()->create();
        $this->be($this->getAdmin());
        $this->delete('/admin/rents/' . $rent->id)
            ->assertRedirect();
    }

    public function test_delete_non_existing_rent(): void
    {
        $this->be($this->getAdmin());
        $this->delete('/admin/rents/0')
            ->assertNotFound();
    }
}
